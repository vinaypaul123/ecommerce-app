@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">All Blog Posts</h1>

    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>

    @foreach ($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title">{{ $post->title }}</h4>
                <p class="card-text">{{ Str::limit($post->body, 100) }}</p>
                <p class="text-muted">By {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}</p>
                <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-info">Read More</a>

                @if(auth()->id() === $post->user_id || auth()->user()->role === 'admin')
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ auth()->user()->role === 'admin' ? route('admin.posts.destroy', $post) : route('posts.destroy', $post) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach

    {{ $posts->links() }}
</div>
@endsection
