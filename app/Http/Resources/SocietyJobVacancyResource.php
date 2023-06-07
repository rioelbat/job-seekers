<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocietyJobVacancyResource extends JsonResource
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
            'category' => $this->jobCategory,
            'company' => $this->company,
            'address' => $this->address,
            'description' => $this->description,
            'available_positions' => $this->availablePositions,
        ];
    }
}
