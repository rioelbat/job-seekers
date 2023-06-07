<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class UnauthorizedUserException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request)
    {
        return response()->error('Unauthorized user', 401);
    }
}
