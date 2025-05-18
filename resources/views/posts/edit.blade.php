@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Post</h2>

    <form method="POST" action="{{ route('posts.update', $post) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Body</label>
            <textarea name="body" class="form-control" rows="5" required>{{ $post->body }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
@endsection
