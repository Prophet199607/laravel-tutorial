<?php

namespace App\Http\Controllers\Posts;

use App\Events\NewPostHasCreatedEvent;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Mail\PostSaveMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('role')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();;
        // return view('posts.index')->with(['posts' => $posts]);
        // return view('posts.index', ['posts' => $posts]);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);
        // return 'success';
        // $post_title = $request->input('post_title');

        // $this->validate($request, [
        //     'post_title' => 'required|min:5',
        //     'post_content' => 'required|min:3|max:250'
        // ]);


        // $request->validate([
        //     'post_title' => 'required|min:3',
        //     'post_content' => 'required|min:3|max:250'
        // ]);  



        $validator  = Validator::make(
            $request->all(),
            [ // rules
                'post_title' => 'required|min:3',
                'post_content' => 'required|min:3|max:250'
            ],
            [ // custom messages
                'post_title.required' => 'this is a custom error message for :attribute',
                // 'required' => 'this is a custom error message for AAAAAA',
            ],
            [ // custom attributes
                'post_title' => 'POST TITLE'
            ]
        )->validate();



        // if ($validator->fails()) {
        //     return redirect()->route('post.create')->withErrors($validator)->withInput();
        // }

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }



        // return $validated = $request->validated(); //return validated data
        $path = 'post_images/default_image.jpg';
        // $request->file('post_image');
        if ($request->hasFile('post_image')) {
            $path = $request->post_image->path();
            $extension = $request->post_image->extension();
            $original_name = $request->post_image->getClientOriginalName();
            $original_extension = $request->post_image->getClientOriginalExtension();
            $mime_type = $request->post_image->getClientMimeType();
            // return $mime_type;

            $path = $request->post_image->store('post_images', 'public');
            // $path = Storage::putFile('post_images', $request->post_image);
        }
        // return $path;

        // $post = User::find(1)->posts()->create(['post_title' => $request->post_title, 'post_content' => $request->post_content, 'image_path' => $path, 'status' => 1]);
        $post = auth()->user()->posts()->create(['post_title' => $request->post_title, 'post_content' => $request->post_content, 'image_path' => $path, 'status' => 1]);

        // dispatch(new SendEmail($post));
        // event(new NewPostHasCreatedEvent($post));

        // return new PostSaveMail();
        // Mail::to('pasindu2k16@gmail.com')->send(new PostSaveMail($post));
        Mail::to('pasindu2k16@gmail.com')->queue(new PostSaveMail($post));

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // $post = Post::findOrFail($id);
        $this->authorize('view', $post);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // $post = Post::find($id);
        if (Gate::allows('delete-post', $post)) {
            // $this->authorize('delete', $post);
            // return Storage::delete(explode('/', $post->image_path)[1]);
            if ($post->image_path != 'post_images/default_image.jpg') {
                unlink(public_path('storage/'. $post->image_path));
            }
            $post->delete();

            request()->session()->flash('success', 'Post deleted successfully!');
            return redirect()->route('post.index');
        }

        request()->session()->flash('error', 'Unauthorized Action!');
        return redirect()->route('post.index');
        
    }
}
