<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Actions\Api\AuthUserAction;
use App\Http\Requests\Api\Auth\LoginRequest;


class AuthController extends Controller
{
    public function __construct(AuthUserAction $action){
        $this->action = $action;
    }

    public function login(LoginRequest $request) {
        return $this->action->userApiLogin($request->validated());
    }

    public function logout() {
        return $this->action->userApiLogout();
    }

    public function logoutAll() {
        return $this->action->userApiLogoutAll();
    }

    public function test()
    {
        echo 'Test Page SS';
    }
}
