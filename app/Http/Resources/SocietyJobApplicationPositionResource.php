<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocietyJobApplicationPositionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public static $wrap = 'position';

    public function toArray(Request $request): array
    {
        return [
            'position' => $this->availablePosition->position,
            'status' => $this->status->getLabelText(),
            'notes' => $this->jobApplySociety->notes,
        ];
    }
}
