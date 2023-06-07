<?php

// Reference:
// Laravel: The BEST way to handle exceptions: https://www.youtube.com/watch?v=0AAg47xygTI
// DRY: Shorter Laravel Responses with Macros: https://www.youtube.com/watch?v=joWaHTwdZR0

namespace App\Providers;

use DB;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();

        Response::macro('success', function ($message, $status_code = 200) {
            return response()->json([
                'message' => $message,
            ], $status_code);
        });

        Response::macro('successWithData', function ($data, $status_code = 200) {
            return response()->json($data, $status_code);
        });

        Response::macro('error', function ($error_message, int $status_code, array $data = []) {
            return response()->json([
                'message' => $error_message,
            ] + $data, $status_code);
        });

        DB::listen(function ($query) {
            Log::info(
                $query->sql,
                [
                    'bindings' => $query->bindings,
                    'time' => $query->time,
                ]
            );
        });
    }
}
