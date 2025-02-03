<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => 'User logged in successfully',
            'data' => [
                'id' => $this->user->id,
                'username' => $this->user->username,
                'last_name' => $this->user->last_name,
                'first_name' => $this->user->first_name,
                'email' => $this->user->email,
                'token' => $this->token,
            ]
        ];
    }
}
