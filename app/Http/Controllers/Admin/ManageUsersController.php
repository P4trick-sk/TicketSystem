<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Mail\MailTest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;

class ManageUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO: skontrolovať, že či funguje unique email
        // TODO: vymazať register controller
        // TODO: pri zadaní hesla pridať IP adresu
        // TODO: oddeliť reset password controller a create user controller
        // TODO: mail pridať do queue
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            /*'password' => ['required', 'confirmed', Rules\Password::defaults()],*/
            'role' => [new Enum(UserRole::class)],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            /*'password' => Hash::make($request->password),
            'reg_ip' => $request->ip(),
            'last_ip' => $request->ip()*/
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        //event(new Registered($user));

        //Auth::login($user);

        return to_route('admin.users.index')->with('status', __($status));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $user = User::findOrFail($id);
        return view('admin.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // TODO: zamädziť zmenu role defaultného administrátora
        $user = User::findOrFail($id);
        return view('admin.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'role' => [new Enum(UserRole::class)],
        ]);

        $user = User::find($id);

        $user->fill($request->only('name', 'email', 'role'));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return to_route('admin.users.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
