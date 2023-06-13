<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($data): array
    {
        return [
            'id' => $data->id,
            'username' => $data->username,
            'firstname' => $data->firstname,
            'lastname' => $data->lastname,
            'email' => $data->email,
            'image' => $data->image,
            'role_id' => $data->role_id,
        ];
    }
}
