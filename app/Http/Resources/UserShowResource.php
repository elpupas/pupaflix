<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'userData' => [
                'id' => $this['userData']['id'],
                'name' => $this['userData']['name'],
                'email' => $this['userData']['email'],

                // Otros datos de userData que deseas mostrar...
            ],
            'address' => [
                'country' => $this['address']['country'],
                'city' => $this['address']['city'],
                'street' => $this['address']['street'],
                'floor' => $this['address']['floor'],
                'door' => $this['address']['door'],
                'zipcode' => $this['address']['zipcode'],

                // Otros datos de address que deseas mostrar...
            ],
        ];
    }
}
