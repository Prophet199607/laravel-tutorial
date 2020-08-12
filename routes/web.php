<?php

use Illuminate\Support\Facades\Route;
use App\Post;
use App\User;
use App\Role;
use App\Country;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/insert', function () {
    Post::create(['post_title' => 'Post Title 1', 'post_content' => 'Post Content 1']);
});

Route::get('/view', function () {
    $posts = Post::all();
    return $posts;
});

Route::get('/select', function () {
    // $post = Post::where('id', 2)->get();
    // $post = Post::where('id', 2)->orderBy('id', 'desc')->take(1)->get();
    // $post = Post::where('id', 2)->first();
    // $post = Post::where('id', 1)->firstOrFail();
    // $post = Post::findOrFail(1);
    // $post = Post::find(1);
    // $post = Post::withTrashed()->where('id', 1)->get();
    $post = Post::onlyTrashed()->where('id', 1)->get();
    return $post;
});

Route::get('/delete', function () {
    // Post::destroy(1);
    Post::findOrFail(2)->delete();
});

Route::get('/softDelete', function () {
    Post::find(1)->delete();
});

Route::get('/restore', function () {
    Post::withTrashed()->where('id', 1)->restore();
});

Route::get('/forceDelete', function () {
    Post::withTrashed()->where('id', 1)->forceDelete();
});

Route::get('/user/{id}/roles', function ($id) {
    $user = User::find($id);
    foreach ($user->roles as $key => $role) {
        echo $role->pivot->status;
    }
});

Route::get('/country/{id}/user', function ($id) {
    $country = Country::find($id);
    foreach ($country->posts as $key => $post) {
        echo $post->post_title;
    }

    // return $country;
});


Route::resource('/post', 'Posts\PostController');
// Route::group(['middleware' => 'role', 'namespace' => 'Posts'], function () {
//     Route::post('/post', 'PostController@store')->name('post.store');;
//     Route::get('/post', 'PostController@index')->name('post.index')->withoutMiddleware('role');
//     Route::get('/post/create', 'PostController@create')->name('post.create');
// });
