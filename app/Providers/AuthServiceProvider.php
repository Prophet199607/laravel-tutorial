<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('add-post', function($user) {
        //     return in_array($user->email, ['spasindu2k16@gmail.com']);
        // });

        Gate::define('delete', function($user, $post) {
            return $user->type == $post->user_id;
        });

        Gate::define('delete-post', 'App\Policies\PostPolicy@delete');
    }
}
