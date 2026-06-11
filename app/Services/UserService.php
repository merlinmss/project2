<?php

namespace App\Services;
use Iqbalatma\LaravelServiceRepo\BaseService;
use Iqbalatma\LaravelServiceRepo\Attributes\ServiceRepository;
use Illuminate\Support\Facades\Http;

//#[ServiceRepository()]
class UserService extends BaseService
{
    public function __construct(){
        $this->apiUrl       =   config('app.api_url');
        $this->token        =   (session('userAccesToken')) ? session('userAccesToken') : '';
    }

    public function getUserProfile(){
        $response           =   Http::withToken($this->token)
                                    ->withHeaders(['Accept' => 'application/json'])
                                    ->get($this->apiUrl . 'profile');
    //    session(['userAccesToken' => $response->json('access_token')]);
        echo '<pre>';
        print_r($response->json());
        echo '</pre>';
    }
    public function getUserList(){
        $page               =   (request()->get('page')) ? '?page='.request()->get('page') : '';
        $response           =   Http::withToken($this->token)
                                    ->withHeaders(['Accept'=>'application/json'])
                                    ->get($this->apiUrl.'user/list'.$page);
        if ($response->successful()) {
            $title          =   "User List";
            $data           =   $response->json('data');
            $users          =   json_decode(json_encode($data['users']));
            return view("pages.users.api_user_list", compact("users", "title"));
            
        } else if ($response->failed()) {
            return redirect()->route('login')->with('error', $response->json('message'));
        }else{
            echo 'Not Success';
        }
        
    }
}
