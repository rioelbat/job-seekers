<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class InvalidTokenException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request)
    {
        return response()->error('Token invalid', 401);
    }
}
