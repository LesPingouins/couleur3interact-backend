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
    public function toArray($test): array
    {
        dd($test);
        return [
            'id' => $test->id,
            'username' => $test->username,
            'firstname' => $test->firstname,
            'lastname' => $test->lastname,
            'email' => $test->email,
            'role_id' => $test->role_id,
        ];
    }
}
