<?php

namespace App\Services;

use App\Models\Validation;

class ValidityService
{
    public function isAccepted(Validation $validation): bool
    {
        return $validation->status->isAccepted();
    }
}
