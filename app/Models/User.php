<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'phone', 'email', 'password', 'status'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

     /**
     * Many-to-Many: User ↔ Roles
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany( UserRole::class, 'user_role_ids', 'user_id', 'role_id')->withTimestamps();
    }

    /**
     * Direct pivot relation (optional)
     */
    public function userRoleIds()
    {
        return $this->hasMany(UserRoleId::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    /**
     * Check if user has a role
     */
    public function hasRole($identifier): bool
    {
        return $this->roles()
            ->where('identifier', $identifier)
            ->exists();
    }

    public function hasAnyRole(array $identifiers): bool
    {
        return $this->roles()
            ->whereIn('identifier', $identifiers)
            ->exists();
    }
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
