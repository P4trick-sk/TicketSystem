<?php

namespace App\Policies;

use App\Models\User;

class ProfilePolicy
{
    /**
     * Create a new policy instance.
     */
    public function update(User $user)
    {
        $services = ['google_id'];

        foreach ($services as $service){
            if ($user[$service] != null) {
                return false;
            }
        }

        return true;
    }
}
