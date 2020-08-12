@extends('layouts.main')

@section('content')
    <div class="mt-5">
        <a href="{{ route('post.create') }}" class="btn btn-primary btn-block btn-quare">Create new post</a>
            <div class="mt-3">
                @foreach ($posts as $post)
                    <div class="card mt-3 shadow bg-white border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <img class="img img-responsive" src="{{ asset('storage/'.$post->image_path) }}" alt="" width="150px">
                                </div>
                                <div class="col-md-10 text-inverse">
                                    <h4 class="card-title"  style="font-weight: bold">{{ $post->post_title }}</h4>
                                    <p class="card-text"  style="font-weight: 500">{{ $post->post_content }}</p>
                                </div>
                            </div>
                        </div>
                        <img class="card-img-bottom" src="" alt="">
                    </div>
                @endforeach 
            </div>
    </div>
@endsection