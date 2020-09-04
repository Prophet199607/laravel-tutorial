<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // factory(App\User::class, 5)->create();
        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10).'@example.com',
        //     'password' => bcrypt(Str::random(5)),
        // ]);

        // DB::statement('SET FORIEGN_KEY_CHECKS=0');

        // DB::table('users')->truncate();
        // DB::table('posts')->truncate();

        factory(App\User::class, 10)->create()->each(function($user) {
            $user->posts()->save(factory(App\Post::class)->make());
        });
    }
}
