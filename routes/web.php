<?php

use Illuminate\Support\Facades\Route;
use App\Post;
use App\User;
use App\Role;
use App\Country;
use App\Mail\PostSaveMail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
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
    Post::create(['user_id' => 1, 'post_title' => 'Post Title 1', 'post_content' => 'Post Content 1']);
});

Route::get('/view', function () {
    // $posts = Post::select('id', 'post_title')->customLatest();
    $posts = Post::select('id', 'post_title')->active()->get();
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


// Route::resource('/post', 'Posts\PostController');
// Route::group(['middleware' => 'role', 'namespace' => 'Posts'], function () {
//     Route::post('/post', 'PostController@store')->name('post.store');
//     Route::get('/post', 'PostController@index')->name('post.index')->withoutMiddleware('role');
//     Route::get('/post/create', 'PostController@create')->name('post.create');
// });
Route::group(['namespace' => 'Posts'], function () {
    Route::post('/post', 'PostController@store')->name('post.store');
    Route::get('/post/create', 'PostController@create')->name('post.create');
    Route::get('/post', 'PostController@index')->name('post.index');
    Route::get('/post/{post}', 'PostController@show')->name('post.show'); //->middleware('can:view,post')
    Route::delete('/post/{post}', 'PostController@destroy')->name('post.destroy');
});

Route::get('/session', function (Request $request) {
    // $request->session()->put('name', 'PROPHET'); // Http session
    // $request->session()->put('id', 100); // Http session
    // session(['id' => 12]); // global session
    // session()->forget('name'); // to delete single session
    // session()->flush();

    // $request->session()->flash('id', 44);
    // $request->session()->flash('name', 'Pasindu');
    // $request->session()->reflash();
    // $request->session()->keep('id');

    return $request->session()->all();
    // return $request->session()->get('name');
    // return session()->get('id');

});

Route::get('/dates', function () {
    // echo Carbon::now();
    // echo now()->addDay()->format('Y-m-d');
    // echo now()->addDays(10)->format('Y-m-d');
    // echo now()->subMinutes(2)->diffForHumans();
    echo now()->subMonths(2)->diffForHumans();
});


Route::get('/accessors/user', function () {
    $user = User::first();
    // return $user->name;
    // return $user->created_at;
    return $user;
});


Route::get('/email', function () {

    $data = [
        'name' => 'PROPHET',
        'verification_code' => rand(1000, 99999),
        'content' => 'This is the content',
    ];
    // return new TestMail($data);
    Mail::to('pasindu2k16@gmail.com')->send(new TestMail($data));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
