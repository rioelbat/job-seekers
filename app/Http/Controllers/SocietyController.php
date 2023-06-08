<?php

namespace App\Http\Controllers;

use App\Exceptions\AuthenticateException;
use App\Exceptions\DataNotFoundException;
use App\Exceptions\DuplicateApplicationException;
use App\Exceptions\PositionNotApplicableException;
use App\Exceptions\ValidationNotAcceptedException;
use App\Http\Requests\LoginSocietyRequest;
use App\Http\Requests\SocietyStoreValidationRequest;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Resources\SocietyJobApplicationCollection;
use App\Http\Resources\SocietyJobVacancyCollection;
use App\Http\Resources\SocietyJobVacancyResource;
use App\Http\Resources\SocietyResource;
use App\Http\Resources\SocietyValidationResource;
use App\Models\Society;
use App\Models\AvailablePosition;
use App\Services\SocietyService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SocietyController extends Controller
{
    private SocietyService $societyService;

    public function __construct(SocietyService $societyService)
    {
        $this->societyService = $societyService;
    }

    /**
     * Login Society
     */
    public function login(LoginSocietyRequest $request): SocietyResource
    {
        try {

            $this->societyService->authenticate($request->validated());

        } catch (ModelNotFoundException $exception) {

            throw new AuthenticateException;
        }

        return new SocietyResource(auth('society')->user());

    }

    /**
     * Logout Society
     */
    public function logout()
    {
        $this->societyService->revokeLoginToken(auth('society-token')->user());

        return response()->success('Logout success');
    }

    public function getValidation(): SocietyValidationResource
    {
        $validation = auth('society-token')->user()->validation;

        if (empty($validation)) {
            throw new DataNotFoundException;
        }

        return new SocietyValidationResource($validation);
    }

    /**
     * Request a validation for Society
     */
    public function requestValidation(SocietyStoreValidationRequest $request)
    {
        $society = auth('society-token')->user();

        if (empty($society->validation)) {

            $this->societyService->createValidation($request->validated(), $society->id);

        }

        return response()->success('Request data validation sent successful');
    }

    /**
     * List Job Vacancies for the Society based on requested Job Category in Society's Validation
     */
    public function indexJobVacancies()
    {
        $job_vacancies = $this->societyService->listPermittedJobVacancies(auth('society-token')->id());

        return new SocietyJobVacancyCollection($job_vacancies);
    }

    /**
     * Show detail of Job Vacancy by id
     */
    public function showJobVacancy(int $job_vacancy_id)
    {
        $job_vacancy = $this->societyService->getPermittedJobVacancy($job_vacancy_id, auth('society-token')->id());

        $job_vacancy->with_apply_count = true; 
        $job_vacancy->positions = AvailablePosition::withCount('jobApplyPositions as apply_count')->where('job_vacancy_id', $job_vacancy->id)->get();

        return new SocietyJobVacancyResource($job_vacancy);
    }

    /**
     * List Society's Applications
     */
    public function indexSocietyApplications()
    {
        $society_applications = auth('society-token')->user()->jobApplySocieties;

        return new SocietyJobApplicationCollection($society_applications);
    }

    /**
     * Store Society's Applications
     */
    public function storeApplication(storeApplicationRequest $request)
    {
        $society_id = auth('society-token')->id();

        if (empty($this->societyService->getAcceptedValidation($society_id))) {

            throw new ValidationNotAcceptedException;
        }

        if ($this->societyService->isHasApplication($request->positions, $society_id)) {

            throw new DuplicateApplicationException;
        }

        if (! $this->societyService->isPositionApplicable($request->positions)) {
            throw new PositionNotApplicableException;
        }

        $this->societyService->applyJobVacancy($request->validated(), $society_id);

        return response()->success('Applying for job successful');
    }
}
