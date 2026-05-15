<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeEmail
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
    public function handle(UserCreated $event): void
    {
        // Access user
        $user = $event->user;

        // Example action
     //   \Mail::to($user->email)->send(new \App\Mail\WelcomeMail($user));
     //   \Mail::to($user->email)->queue(new \App\Mail\WelcomeMail($user));
     //   \Mail::to($user->email)->later(now()->addMinutes(5), new \App\Mail\WelcomeMail($user));
        \Mail::to('merlin@fortigrid.com')->queue(new \App\Mail\WelcomeMail($user));
    }
}
