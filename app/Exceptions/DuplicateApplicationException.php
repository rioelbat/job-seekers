<?php

// Reference:
// Laravel: The BEST way to handle exceptions: https://www.youtube.com/watch?v=0AAg47xygTI
// DRY: Shorter Laravel Responses with Macros: https://www.youtube.com/watch?v=joWaHTwdZR0

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class DuplicateApplicationException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request)
    {
        return response()->error('Application for a job can only be once', 401);
    }
}
