<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'lastname' => $this->lastname,
            'name' => $this->name,
            'patronymic' => $this->patronymic,
            'telephone' => $this->telephone,
            'avatar' => $this->avatar,
            'isAdmin' => $this->is_admin,
            'email' => $this->email,
            'emailVerified' => $this->email_verified_at,
        ];
    }
}
