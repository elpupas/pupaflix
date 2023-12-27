<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'country' => $this->country,
            'city' => $this->city,
            'street' => $this->street,
            'floor' => $this->floor,
            'door' => $this->door,
            'zipcode' => $this->zipcode,
        ];
    }
}
