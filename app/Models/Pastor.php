<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['fname', 'lname', 'phone', 'email', 'region_id', 'profile_photo'])]

class Pastor extends Model
{
    use SoftDeletes;
    /**
     * Many-to-Many: Pastor ↔ Roles
     */
    public function pastorRoles(): BelongsToMany
    {
        return $this->belongsToMany(PastorRole::class, 'pastor_role_ids', 'pastor_id', 'pastor_role_id')->withTimestamps();
    }

    /**
     * Direct pivot relation (optional)
     */
    public function pastorRoleIds()
    {
        return $this->hasMany(PastorRoleId::class);
    }
}
