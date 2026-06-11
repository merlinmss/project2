<?php
namespace App\Actions\Api;

use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


use App\Models\User;
use App\Models\UserRole;
use App\Models\UserRoleId;
class UserAction
{
    public function __construct(
       
    ) {}

    public function apiUserList(){
        $users              =   User::with('roles')->paginate(5);
        return response()   ->  json([
            'success'       =>  true,
            'message'       =>  'Users retrieved successfully.',
            'data'          =>  ['usrData' => UserResource::collection($users),'users'=> $users],
            'errors'        =>  []
        ], Response::HTTP_OK);
    }

    public function userProfile(){
        $user               =   auth()->user();
        return response()   ->  json([
            'success'       =>  true,
            'message'       =>  'User profile retrieved successfully.',
            'data'          =>  new UserResource($user),
            'errors'        =>  []
        ], Response::HTTP_OK);
    }
}
