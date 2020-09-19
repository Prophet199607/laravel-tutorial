@extends('layouts.app')

@section('content')
    <div class="mt-5">
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-8" style="margin: 0 auto">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('post.index') }}" class="btn btn-secondary btn-block btn-quare" style="width: 80px">< Back</a>
                            @can('delete', $post)
                                <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-block btn-quare" style="width: 80px">Delete</button>
                                </form>
                            @endcan
                                {{-- <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-block btn-quare" style="width: 80px">Delete</button>
                                </form> --}}
                        </div>
                        <div class="card mt-3 shadow bg-white border-0">
                            <div class="card-header text-center bg-info text-white">
                                <h4 class="card-title mt-2"  style="font-weight: bold">{{ $post->post_title }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 p-2">
                                        <img class="img img-responsive" src="{{ asset('storage/'.$post->image_path) }}" alt="" height="400px">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <h5 class="card-text ml-4"  style="font-weight: 500">{{ $post->post_content }}</h5>
                                    </div>
                                    <div class="col-md-12 mt-3 text-primary">
                                        <p>Comments</p>
                                        <form action="{{ route('comments.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="post_id" value={{ $post->id }}>
                                            <div class="form-group">
                                                <textarea name="comment" class="form-control" name="" rows="2" placeholder="Enter your comment here"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-success float-right">Submit</button>
                                        </form>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        @foreach ($post->comments as $comment)
                                            <div class="card mt-1">
                                                <div class="card-body">
                                                    <strong>{{$comment->user->name}} - {{$comment->created_at}}</strong>
                                                    <p>{{$comment->comment}}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection