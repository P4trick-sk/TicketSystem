<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ApproveUserController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (!$user->isApproved())
        {
            $user->approved_at = now();
            $user->save();
        }
        return to_route('admin.users.show', $user->id);
    }
}
