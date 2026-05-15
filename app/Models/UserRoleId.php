<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;

use Illuminate\Database\Eloquent\Model;
use Laravel\Prompts\Table;

#[Fillable(['user_id', 'role_id'])]
#[table('user_role_ids')]
class UserRoleId extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }
}
