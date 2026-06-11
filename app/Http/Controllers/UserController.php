<?php
namespace App\Http\Controllers;

use App\Actions\UserAction;
use App\DTOs\User\CreateUserData;
use App\Http\Requests\User\CreateUserRequest;

use App\Services\UserService;

use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct(UserAction $action, UserService $userService){
        $this->action           =   $action;
        $this->userService      =   $userService;
    }
    public function get(){
        return $this->action->list();
    }
    public function store(CreateUserRequest $request) {
        $userData           =   (array) CreateUserData::fromArray($request->validated());
        $user               =   $this->action->execute($userData);
        if($user)
            return redirect()->route('user.list')->with('success', 'User saved successfully.');
        else
            return redirect()->back()->with('danger', 'Something went wrong.')    ;
    }

    public function show($id){
        return $this->action->find($id);
    }

    public function destroy($id){
        $result     = $this->action->deleteUser($id);
        if($result)
            return redirect()->back()->with('success', 'Record deleted successfully!');
        else
            return redirect()->back()->with('danger', 'Somthing went wrong. Plrase try later');
    }

    public function apiProfile(){
        $result = $this->userService->getUserProfile();
    }

    public function apiUserList(){
        return   $this->userService->getUserList();
    }

}
