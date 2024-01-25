<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GroupsPolicy
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
    public function view(User $user, Group $group): bool
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
    public function update(User $user, Group $group): Response
    {
        return $user->id == $group->createdBy->id
            ? Response::allow()
            : Response::deny('Nemáte oprávnenie na upravenie skupiny.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Group $group): Response
    {
        return $user->id == $group->createdBy->id
            ? Response::allow()
            : Response::deny('Nemáte oprávnenie na zmazanie skupiny.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Group $group): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Group $group): bool
    {
        //
    }
}
