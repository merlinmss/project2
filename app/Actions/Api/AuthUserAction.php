<?php
namespace App\Actions\Api;

use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;
class AuthUserAction
{
    public function __construct(
       
    ) {}

    public function userApiLogin($credentials){
        // Query user securely
        $user           =   User::where('email', $credentials['email'])->first();

        // Constant-time string verification to prevent timing attacks
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'success' => true,
                'message' => 'The provided credentials do not match our records.',
                'data' => [],
                'errors' => []
            ], Response::HTTP_UNAUTHORIZED); // 401
        }

        // Issue token with specified abilities if needed
        $token = $user->createToken($credentials['device_name'], ['*'])->plainTextToken;

        // Standardized response format
        return response()->json([
            'success' => true,
            'message' => 'Authentication successful.',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => [
                'user' => new UserResource($user),
            ],
            'errors' => []
        ], Response::HTTP_OK); // 200
    }

    public function userApiLogout(){
        request()->user()
            ->currentAccessToken()
                ?->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }
    
    public function userApiLogoutAll(){
        request()->user()
            ->tokens()
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out from all devices'
        ]);
    }
}
