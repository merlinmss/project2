<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


use Illuminate\Database\Eloquent\Model;

#[Fillable(['role_name', 'identifier', 'active'])]
class UserRole extends Model
{
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_role_ids',
            'role_id',
            'user_id'
        )->withTimestamps();
    }

    public function userRoleLinks()
    {
        return $this->hasMany(UserRoleId::class, 'role_id');
    }
    /**
     * Direct pivot relation
     */
    public function userRoleIds()
    {
        return $this->hasMany(UserRoleId::class, 'role_id');
    }
}
