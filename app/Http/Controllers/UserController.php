<?php
namespace App\Http\Controllers;

use App\Actions\User\CreateUserAction;
use App\DTOs\User\CreateUserData;
use App\Http\Requests\User\CreateUserRequest;

use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct(CreateUserAction $action){
        $this->action = $action;
    }
    public function get(){
        return $this->action->list();
    }
    public function store(CreateUserRequest $request) {

        $userData           =   (array) CreateUserData::fromArray($request->validated());
        $user               =   $this->action->execute($userData);
        return redirect()->back()->with('success', 'User saved successfully.')    ;
    }

    public function show($id){
        return $this->action->find($id);
    }

}
