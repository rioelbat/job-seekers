<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocietyJobApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public static $wrap = 'vacancy';

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'job_category' => $this->jobVacancy->jobCategory,
            'company' => $this->jobVacancy->company,
            'address' => $this->jobVacancy->address,
            'positions' => new SocietyJobApplicationPositionCollection($this->jobApplyPositions),
        ];
    }
}
