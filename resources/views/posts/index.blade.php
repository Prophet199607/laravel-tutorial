@extends('layouts.main')

@section('content')
    <div class="mt-5">
        <a href="{{ route('post.create') }}" class="btn btn-primary btn-block btn-quare">Create new post</a>
            <div class="mt-3">
                @foreach ($posts as $post)
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img class="img img-responsive" src="{{ asset('storage/'.$post->image_path) }}" alt="" width="150px">
                            </div>
                            <div class="col-md-10">
                                <h5 class="card-title">{{ $post->post_title }}</h5>
                                <p class="card-text">{{ $post->post_content }}</p>
                            </div>
                        </div>
                    </div>
                    <img class="card-img-bottom" src="" alt="">
                </div>
            @endforeach 
            </div>
    </div>
@endsection