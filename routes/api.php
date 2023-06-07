<?php

use App\Http\Controllers\SocietyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'auth'], function () {

        Route::post('login', [SocietyController::class, 'login']);
        Route::middleware('auth:society-token')->post('logout', [SocietyController::class, 'logout']);

    });

    Route::group(['middleware' => 'auth:society-token'], function () {

        Route::post('validations', [SocietyController::class, 'requestValidation']);
        Route::get('validations', [SocietyController::class, 'getValidation']);

        Route::get('job_vacancies/{id}', [SocietyController::class, 'showJobVacancy'])->whereNumber('id');
        Route::get('job_vacancies', [SocietyController::class, 'indexJobVacancies']);

        Route::post('applications', [SocietyController::class, 'storeApplication']);
        Route::get('applications', [SocietyController::class, 'indexSocietyApplications']);

    });

});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
