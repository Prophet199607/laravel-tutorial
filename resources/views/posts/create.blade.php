@extends('layouts.main')

@section('content')
    <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="post_title">Post Title</label>
                    <input id="post_title" class="form-control @error('post_title') is-invalid  @enderror" type="text" name="post_title" value="{{ old('post_title') }}">
                    @error('post_title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="post_content">Post Content</label>
                        <textarea id="post_content" class="form-control @error('post_content') is-invalid  @enderror" type="text" name="post_content" rows="3">{{ old('post_content') }}</textarea>
                        @error('post_content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <input type="file" name="post_image">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('post.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </form>
@endsection