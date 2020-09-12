<?php

namespace App\Listeners;

use App\Mail\PostSaveMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PostUnderReviewListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // sleep(10);
        Mail::to($event->post->user->email)->send(new PostSaveMail($event->post));
    }
}
