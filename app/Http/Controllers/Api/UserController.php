<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Actions\Api\UserAction;

use App\Models\User;
class UserController extends Controller
{
    public function __construct(UserAction $action){
        $this->action = $action;
    }

    public function userList() {
        return $this->action->apiUserList();
    }
    
    public function profile() {
        return $this->action->userProfile();
    }

}
