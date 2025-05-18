@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            <p class="text-muted">By {{ $post->user->name }} | {{ $post->created_at->format('F d, Y') }}</p>
            <p class="card-text">{{ $post->body }}</p>
        </div>
    </div>

    <hr>

    <h4>Comments ({{ $post->comments->count() }})</h4>

    @foreach ($post->comments as $comment)
        <div class="mb-2 border-bottom pb-2">
            <strong>{{ $comment->user->name }}</strong>
            <span class="text-muted"> | {{ $comment->created_at->diffForHumans() }}</span>
            <p>{{ $comment->body }}</p>
        </div>
    @endforeach

    <hr>

    <h5>Add a Comment</h5>
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">

        <div class="mb-3">
            <textarea name="body" class="form-control" rows="3" placeholder="Write a comment..." required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Post Comment</button>
    </form>
</div>
@endsection
