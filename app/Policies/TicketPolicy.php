<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TicketPolicy
{
    /**
     * Enables admin to perform any action.
     * @param User $user
     * @param string $ability
     * @return bool|null
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ticket $ticket): Response
    {
        return $user->id == $ticket->createdBy->id || $user->id == $ticket->assignedTo->id
            ? Response::allow()
            : Response::deny('Nemáte oprávnenie na prezeranie ticketu.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->isNotBanned()
            ? Response::allow()
            : Response::deny('Nemôžete vytvárať tickety, ste zabanovaný.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ticket $ticket): Response
    {
        return ($user->id == $ticket->createdBy->id || $user->id == $ticket->assignedTo->id) && $ticket->deleted_at == null
            ? Response::allow()
            : Response::deny('Nemáte oprávnenie na editovanie ticketu.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function updateBasic(User $user, Ticket $ticket): Response
    {
        return $user->id == $ticket->createdBy->id && $ticket->deleted_at == null
            ? Response::allow()
            : Response::deny('Nemáte oprávnenie na editovanie ticketu.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function updateAdvanced(User $user, Ticket $ticket): Response
    {
        return $user->id == $ticket->assignedTo->id && $ticket->deleted_at == null
            ? Response::allow()
            : Response::deny('Nemáte oprávnenie na editovanie ticketu.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ticket $ticket): Response
    {
        return $user->id == $ticket->assignedTo->id
            ? Response::allow()
            : Response::deny('Nemáte oprávnenie na zmazanie ticketu.');
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

    /**
     * Determine whether the user can create models.
     */
    public function canRespond(User $user, Ticket $ticket): Response
    {
        return ($user->id == $ticket->createdBy->id || $user->id == $ticket->assignedTo?->id) && $ticket->deleted_at == null
            ? Response::allow()
            : Response::deny('Nemáte oprávnenie na tento ticket odpovedať.');
    }
}
