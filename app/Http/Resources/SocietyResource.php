<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocietyResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'born_date' => $this->born_date,
            'gender' => $this->gender->getLabelText(),
            'address' => $this->address,
            'token' => $this->login_tokens,
            'regional' => [
                'id' => $this->regional->id,
                'province' => $this->regional->province,
                'district' => $this->regional->district,
            ],
        ];
    }
}
