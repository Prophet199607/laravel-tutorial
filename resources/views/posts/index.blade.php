@extends('layouts.app')

@section('content')
    <div class="mt-5">
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{session('error')}}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{session('success')}}
            </div>
        @endif
        <a href="{{ route('post.create') }}" class="btn btn-primary btn-block btn-quare">Create new post</a>
            <div class="mt-3">
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-md-3">
                            <div class="card mt-3 shadow bg-white border-0">
                                <div class="card-header text-center bg-success text-white">
                                    <a href="{{ route('post.show', $post->id) }}">
                                        <h4 class="card-title mt-2"  style="font-weight: bold; text-decoration: none; color: #fff">{{ $post->post_title }}</h4>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <img class="img img-responsive" src="{{ asset('storage/'.$post->image_path) }}" alt="" width="100%">
                                    <h6 class="card-text"  style="font-weight: 500">{{ $post->post_content }}</h6>
                                </div>
                            </div>
                        </div>
                @endforeach 
                </div>
            </div>
    </div>
@endsection