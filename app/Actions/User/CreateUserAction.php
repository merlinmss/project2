<?php
namespace App\Actions\User;

use App\DTOs\User\CreateUserData;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Events\UserCreated;
use App\Models\UserRole;
use App\Models\UserRoleId;
use App\Mail\WelcomeMail;
class CreateUserAction
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    public function list(){
        $users              =   $this->userRepository->fetchUserList();
        $title              =   "User List";  
        return view("pages.users.user_list", compact("users", "title"));
    }
    public function find($id){
        $user               =   $this->userRepository->find($id );
        $roles              =   UserRole::where("active", 1)->get();
        $title              =   ($id == 0) ? "Create User" : "Edit User";
        return view("pages.users.user_detail", compact("user", "roles", "title"));
    }
    public function execute(array $data)
    {
        if (request()->input('id')  ==  0) {
            $data['password']       =   Hash::make(createRandomString(10));
        }
        $user                       =   $this->userRepository->save($data);
        if($user){ $roleIds         =   $this->userRepository->saveUserRoleIds($user);}
        if(request()->input('id')   >   0) event(new UserCreated($user));
        return $user;
    }
    
}
