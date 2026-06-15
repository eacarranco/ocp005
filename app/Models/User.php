<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

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
            'password_changed_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($user) {
            $user->password_changed_at = null;
        });
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_has_roles');
    }

    public function passwordHistories(): HasMany
    {
        return $this->hasMany(PasswordHistory::class);
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

    public function mustChangePassword(): bool
    {
        if (is_null($this->password_changed_at)) {
            return true;
        }

        $expiryDays = (int) Setting::getValue('password_expiry_days', 90);
        return $this->password_changed_at->addDays($expiryDays)->isPast();
    }

    public function storePasswordHistory(): void
    {
        $this->passwordHistories()->create([
            'password' => $this->password,
        ]);

        $this->passwordHistories()
            ->orderBy('created_at', 'desc')
            ->skip(3)
            ->limit(999)
            ->delete();
    }

    public function isPasswordReused(string $newPassword): bool
    {
        foreach ($this->passwordHistories as $history) {
            if (Hash::check($newPassword, $history->password)) {
                return true;
            }
        }
        return false;
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
