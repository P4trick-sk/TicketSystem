<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver( 'google')->redirect();
    }

    public function callback(Request $request)
    {
        $user = Socialite::driver('google')->user();

        $user = User::updateOrCreate([
            'google_id' => $user->id,
        ], [
            'name' => $user->name,
            'email' => $user->email,
            'google_id' => $user->id,
            'avatar' => $user->getAvatar(),
            'email_verified_at' => now(),
            'approved_at' => now(),
            'google_token' => $user->token,
            'google_refresh_token' => $user->refreshToken,
            'last_ip' => $request->ip()
        ]);

        if ($user->reg_ip == null) {
            $user->reg_ip = $request->ip();
            $user->save();
        }

        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
