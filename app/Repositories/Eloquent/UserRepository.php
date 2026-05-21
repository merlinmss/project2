<?php

namespace App\Repositories\Eloquent;


use App\Models\User;
use App\Models\UserRoleId;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function save(array $data): User
    {
        if(request()->input('id')>0) {
            $user = User::find(request()->input('id'));
            foreach($data as $k=>$val){ $user->$k = $val; }
            $user->save();
        }else{
            $user = new User($data);
            $user->save();
        }
        if (request()->hasFile('profile_pic')) {
            $storageDevice = config('filesystems.default');
            // delete old image from storage
            if (isset($user->profile_pic) && Storage::disk($storageDevice)->exists($user->profile_pic)) {
                Storage::disk($storageDevice)->delete($user->profile_pic);
            }
            // store new image and update user record
            $filePath           =   config('app.uploadBaseDir')."users/$user->id/profile_pic";
            $filename           =   request()->file('profile_pic')->store($filePath, $storageDevice);
            $user->profile_pic  =   $filename;
            $user->save();
        }
        return $user;
    }
    public function saveUserRoleIds($user)
    {
        UserRoleId::where('user_id', $user->id)->delete();
        $user->roles()->attach(request()->input('roles'));
    }

    public function fetchUserList()
    {
        return User::with('roles')->paginate(10);
    }
    
    public function find($id)
    {
        return User::find($id);
    }
    
}
