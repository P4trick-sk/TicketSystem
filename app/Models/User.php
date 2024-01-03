<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'reg_ip',
        'last_ip',
        'logged_at',
        'approved_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => UserRole::class,
    ];

    /**
     * Returns whenever user has admin role or not.
     * @return bool
     */
    public function isAdmin(): bool
    {
        if ($this->role == UserRole::Admin) {
            return true;
        }
        return false;
    }

    public function isTeacher(): bool
    {
        if ($this->role == UserRole::Teacher || $this->role == UserRole::Admin) {
            return true;
        }
        return false;
    }

    public function isBanned(): bool
    {
        if ($this->status == 'banned'){
            return true;
        }
        return false;
    }

    public function isNotBanned(): bool
    {
        return !$this->isBanned();
    }

    /**
     * Updates login info at login.
     * @param Carbon $logged_at
     * @param string|null $last_ip
     * @return void
     */
    public function updateLoginInfo(Carbon  $logged_at, ?string $last_ip): void
    {
        $this->update([
            'logged_at' => $logged_at,
            'last_ip' => $last_ip,
        ]);
    }

    public function isApproved(): bool
    {
        return $this->approved_at ? true : false;
    }
}
