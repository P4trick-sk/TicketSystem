<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserBanned;
use App\Events\UserUnbanned;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UserBanController extends Controller
{
    public function ban(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->id == $user->id) {
            return back()->withErrors(['ban' => __('admin.ban.self')]);
        }

        $user->status = 'banned';

        $user->save();

        event(new UserBanned($user));

        return to_route('admin.users.show', $user->id);
    }

    public function unban(Request $request, User $user): RedirectResponse
    {
        $user->status = 'active';

        $user->save();

        event(new UserUnbanned($user));

        return to_route('admin.users.show', $user->id);
    }
}
