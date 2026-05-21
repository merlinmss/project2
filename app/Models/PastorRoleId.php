<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['pastor_id', 'pastor_role_id'])]
class PastorRoleId extends Model
{
    use SoftDeletes;

    public function pastor()
    {
        return $this->belongsTo(Pastor::class);
    }

    public function pastorRole()
    {
        return $this->belongsTo(PastorRole::class, 'role_id');
    }
}
