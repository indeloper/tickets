<?php

namespace App\Http\Resources;

use App\Http\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'last_name' => $this->last_name,
            'second_name' => $this->second_name,
            'first_name' => $this->first_name,
            'email' => $this->email,
            'role' => $this->roles()->first()->name,
            'role_name' => RolesEnum::from($this->roles()->first()->name)->label(),
            'blocked' => $this->blocked,
            'activated' => $this->activated
        ];
    }
}
