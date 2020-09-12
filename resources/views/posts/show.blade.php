@extends('layouts.app')

@section('content')
    <div class="mt-5">
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-8" style="margin: 0 auto">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('post.index') }}" class="btn btn-secondary btn-block btn-quare" style="width: 80px">< Back</a>
                            {{-- @can('delete', $post)
                                <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-block btn-quare" style="width: 80px">Delete</button>
                                </form>
                            @endcan --}}
                                <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-block btn-quare" style="width: 80px">Delete</button>
                                </form>
                        </div>
                        <div class="card mt-3 shadow bg-white border-0">
                            <div class="card-header text-center bg-info text-white">
                                <h4 class="card-title mt-2"  style="font-weight: bold">{{ $post->post_title }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <img class="img img-responsive" src="{{ asset('storage/'.$post->image_path) }}" alt="" height="400px">
                                    <h5 class="card-text ml-4"  style="font-weight: 500">{{ $post->post_content }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection