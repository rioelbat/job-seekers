<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class ServerBusyException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request)
    {
        return response()->error('Server is busy. Let’s try again and see if it works this time!', 500);
    }
}
