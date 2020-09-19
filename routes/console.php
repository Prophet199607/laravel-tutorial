<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');


Artisan::command('post:clean', function () {
    $this->info('cleaning..');
    $posts = App\Post::doesntHave('comments')
        ->get()
        ->each(function($post) {
            $post->delete();
            $this->warn('Deleted:' . $post->post_title);
        });

        if ($posts->isEmpty()) {
            $this->info('Nothing to clear!');
            return;
        }

        $this->info('completed!');
})->describe('Cleans up unused posts');