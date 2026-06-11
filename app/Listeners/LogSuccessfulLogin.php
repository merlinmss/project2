<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
      //  echo '<pre>'; print_r(request()->all()); echo '</pre>';
        $response = Http::withHeaders(['Accept' => 'application/json'])
            ->post(config('app.api_url') . 'login',['email'=>request()->post('email'),'password'=> request()->post('password'),'device_name'=>'Web']);
        if($response->status() == 200){
            session(['userAccesToken' => $response->json('access_token')]);
        }else{
            session(['userAccesToken' => '']);
        }
    }
}
