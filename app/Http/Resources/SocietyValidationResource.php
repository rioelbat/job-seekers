<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocietyValidationResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status->getLabelText(),
            'work_experience' => $this->work_experience,
            'job_category_id' => $this->job_category_id,
            'job_position' => $this->job_position,
            'reason_accepted' => $this->reason_accepted,
            'validator_notes' => $this->validator_notes,
            'validator' => $this->validator,
        ];
    }
}
