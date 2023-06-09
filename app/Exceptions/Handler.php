<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (AuthenticationException $e, $request) {
            if ($request->is('api/v1/auth/login')) {
                return response()->error('ID Card Number or Password incorrect', 401);
            }

            if ($request->is('api/v1/auth/logout')) {
                return response()->error('Invalid token', 401);
            }

            return response()->error('Unauthorized user', 401);
        });

        $this->renderable(function (ValidationException $e, $request) {
            if ($request->is('api/v1/applications')) {
                return response()->error('Invalid field', 401, ['errors' => $e->errors()]);
            }
        });

    }
}
