<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class CreateUserRequest extends FormRequest
{
    public function rules(){
        return [
            'name' => 'required|string',

            'phone' => [
                'required',
                'integer',
                Rule::unique((new User)->getTable(), 'phone')
                    ->ignore(request()->input('id')),
            ],

            'email' => [
                'required',
                'email',
                Rule::unique((new User)->getTable(), 'email')
                    ->ignore(request()->input('id')),
            ],

        //    'roles' => 'required|array',
        //    'roles.*' => 'exists:user_roles,id', 
            'profile_photo' => 'image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|integer',
        ];
    }
}
