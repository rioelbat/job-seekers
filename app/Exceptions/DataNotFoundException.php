<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class DataNotFoundException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request)
    {
        return response()->error('Data is not available', 404);
    }
}
