<?php

namespace App\Policies;

use App\Http\Enums\RolesEnum;
use App\Models\Ticket;
use App\Models\User;
use Codewiser\Workflow\Transition;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ticket $ticket): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ticket $ticket): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ticket $ticket): Response
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
    public function restore(User $user, Ticket $ticket): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ticket $ticket): bool
    {
        //
    }

    public function state(User $user, Ticket $ticket, Transition $transition): Response
    {

    }

    public function budget(User $user, Ticket $ticket): Response
    {
        return Response::allow();
    }
}
