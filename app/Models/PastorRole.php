<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['role_name','is_active'])]
class PastorRole extends Model
{
    use SoftDeletes;

    public function pastors(): BelongsToMany
    {
        return $this->belongsToMany(
            Pastor::class,
            'pastor_role_ids',
            'pastor_role_id',
            'pastor_id'
        )->withTimestamps();
    }

    public function pastorRoleLinks()
    {
        return $this->hasMany(PastorRoleId::class, 'pastor_role_id');
    }
   
}
