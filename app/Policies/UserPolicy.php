<?php

namespace App\Policies;

use App\Http\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->hasAnyRole([
            RolesEnum::SUPERADMIN->value,
            RolesEnum::ADMIN->value
        ])
            ? $this->allow()
            : $this->deny('Действие запрещено. Обратитесь к администратору системы.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): Response
    {
        return $user->hasAnyRole([
            RolesEnum::SUPERADMIN->value,
            RolesEnum::ADMIN->value
        ])
            ? $this->allow()
            : $this->deny('Действие запрещено. Обратитесь к администратору системы.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->hasAnyRole([
            RolesEnum::SUPERADMIN->value,
            RolesEnum::ADMIN->value
        ])
            ? $this->allow()
            : $this->deny('Действие запрещено. Обратитесь к администратору системы.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): Response
    {
        return $user->hasAnyRole([
            RolesEnum::SUPERADMIN->value,
            RolesEnum::ADMIN->value
        ])
            ? $this->allow()
            : $this->deny('Действие запрещено. Обратитесь к администратору системы.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): Response
    {
        return $user->hasAnyRole([
            RolesEnum::SUPERADMIN->value,
            RolesEnum::ADMIN->value
        ])
            ? $this->allow()
            : $this->deny('Действие запрещено. Обратитесь к администратору системы.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): Response
    {
        return $user->hasAnyRole([
            RolesEnum::SUPERADMIN->value,
            RolesEnum::ADMIN->value
        ])
            ? $this->allow()
            : $this->deny('Действие запрещено. Обратитесь к администратору системы.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): Response
    {
        return $user->hasAnyRole([
            RolesEnum::SUPERADMIN->value,
            RolesEnum::ADMIN->value
        ])
            ? $this->allow()
            : $this->deny('Действие запрещено. Обратитесь к администратору системы.');
    }
}
