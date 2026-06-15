<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_has_roles');
    }

    public function hasPermission(string $permission): bool
    {
        foreach ($this->roles as $role) {
            $role->loadMissing('permissions');
            if ($role->permissions->contains('name', $permission)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermissionWildcard(string $prefix): bool
    {
        foreach ($this->roles as $role) {
            $role->loadMissing('permissions');
            foreach ($role->permissions as $perm) {
                if (str_starts_with($perm->name, $prefix)) {
                    return true;
                }
            }
        }
        return false;
    }

    public function hasRole(string $role): bool
    {
        return $this->roles->contains('name', $role);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('Administrador');
    }
}
