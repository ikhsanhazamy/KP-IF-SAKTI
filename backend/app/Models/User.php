<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'jabatan',
        'role',
        'photo',
        'two_factor_enabled',
        'password',
    ];

    public function isSuperAdmin(): bool
    {
        return ($this->role ?? 'admin') === 'super_admin';
    }

    public function isAdmin(): bool
    {
        return in_array($this->role ?? 'admin', ['super_admin', 'admin'], true);
    }

    public function hasRole(string|array $roles): bool
    {
        $roles = is_array($roles) ? $roles : explode(',', $roles);
        $userRole = $this->role ?? 'admin';

        return in_array($userRole, $roles, true);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_enabled' => 'boolean',
        ];
    }
}
