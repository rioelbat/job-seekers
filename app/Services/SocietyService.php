<?php

namespace App\Services;

use DB;
use App\Enums\ValidationStatus;
use App\Exceptions\DataNotFoundException;
use App\Exceptions\ValidationNotAcceptedException;
use App\Exceptions\ServerBusyException;
use App\Models\AvailablePosition;
use App\Models\JobApplyPosition;
use App\Models\JobApplySociety;
use App\Models\JobVacancy;
use App\Models\Society;
use App\Models\Validation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SocietyService
{
    public function regenerateLoginToken(Society $society): Society
    {
        return $this->setLoginToken($society, md5($society->id_card_number));
    }

    public function revokeLoginToken(Society $society): Society
    {
        return $this->setLoginToken($society, '');
    }

    public function setLoginToken(Society $society, string $login_tokens): Society
    {
        $society->login_tokens = $login_tokens;
        $society->save();

        return $society;
    }

    public function getSocietyByAuth(array $credentials): Society
    {
        if (empty($credentials['id_card_number']) || empty($credentials['password'])) {
            throw new ModelNotFoundException;
        }

        return Society::where($credentials)->firstOrFail();
    }

    public function authenticate(array $credentials): Society
    {
        $society = $this->getSocietyByAuth($credentials);

        $society = $this->regenerateLoginToken($society);

        auth('society')->setUser($society);

        return $society;
    }

    public function createValidation(array $validationData, int $society_id): Validation
    {
        return Validation::create([
            'job_category_id' => $validationData['job_category_id'],
            'work_experience' => $validationData['work_experience'],
            'job_position' => $validationData['job_position'],
            'reason_accepted' => $validationData['reason_accepted'],
            'society_id' => $society_id,
        ]);
    }

    public function getPermittedJobVacancy(int $job_vacancy_id, int $society_id)
    {
        $validation = $this->getAcceptedValidation($society_id);

        if (empty($validation)) {
            throw new ValidationNotAcceptedException;
        }

        $job_vacancy = JobVacancy::where('job_category_id', $validation->job_category_id)
            ->where('id', $job_vacancy_id)
            ->first();

        if (empty($job_vacancy)) {
            throw new DataNotFoundException;
        }

        return $job_vacancy;
    }

    public function listPermittedJobVacancies(int $society_id)
    {
        $validation = $this->getAcceptedValidation($society_id);

        if (empty($validation)) {
            throw new ValidationNotAcceptedException;
        }

        $job_vacancies = JobVacancy::where('job_category_id', $validation->job_category_id)->get();

        if (empty($job_vacancies)) {
            throw new DataNotFoundException;
        }

        return $job_vacancies;
    }

    public function listAppliedVacancies(Society $society)
    {
        if (empty($society->jobApplySocities)) {
            throw new DataNotFoundException;
        }

        return $job_vacancies;
    }

    public function applyJobVacancy(array $jobApplicationData, int $society_id)
    {

        DB::beginTransaction();

        try {
            $job_apply_society = JobApplySociety::create([
                'job_vacancy_id' => $jobApplicationData['vacancy_id'],
                'society_id' => $society_id,
                'notes' => $jobApplicationData['notes'],
                'date' => now()->format('Y-m-d'),
            ]);
    
            $job_apply_positions_data = [];
    
            foreach ($jobApplicationData['positions'] as $position_id) {
                $job_apply_positions_data[] = [
                    'job_vacancy_id' => $jobApplicationData['vacancy_id'],
                    'position_id' => $position_id,
                    'date' => $job_apply_society->date,
                    'society_id' => $society_id,
                ];
            }
    
            $job_apply_society->jobApplyPositions()->createMany($job_apply_positions_data);
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            throw New ServerBusyException;
        } catch (Throwable $e) {
            DB::rollback();

            throw New ServerBusyException;
        }

        
    }

    public function isPositionApplicable(array $selectedPositions)
    {
        $positions = AvailablePosition::withCount('jobApplyPositions as applicants_count')
            ->whereIn('id', $selectedPositions)
            ->get();

        if (empty($positions)) {
            return false;
        }

        return $positions->filter(function ($available_position) {
            return $available_position->applicants_count >= $available_position->apply_capacity;
        })->count() === 0;
    }

    public function getAcceptedValidation(int $society_id)
    {
        return Validation::where('society_id', $society_id)->where('status', ValidationStatus::ACCEPTED)->first();
    }

    public function isHasApplication(array $selectedPositions, int $society_id): bool
    {
        return JobApplyPosition::where('society_id', $society_id)
            ->whereIn('job_apply_positions.position_id', $selectedPositions)
            ->select(['society_id', 'position_id'])
            ->count() > 0;
    }
}
