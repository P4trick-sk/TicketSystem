<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UserBanController extends Controller
{
    public function ban(Request $request, string $id): RedirectResponse
    {
        if ($request->user()->id == $id) {
            return back()->withErrors(['ban' => __('admin.ban.self')]);
        }

        $user = User::find($id);

        $user->status = 'banned';

        $user->save();

        return to_route('admin.users.show', $id);
    }

    public function unban(Request $request, string $id): RedirectResponse
    {
        $user = User::find($id);

        $user->status = 'active';

        $user->save();

        return to_route('admin.users.show', $id);
    }
}
