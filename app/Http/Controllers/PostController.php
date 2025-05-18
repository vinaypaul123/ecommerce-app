<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created.');
    }

    public function show(Post $post)
    {
        $post->load(['comments.user']);
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        if ($post->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);

        $post->update($request->only('title', 'body'));

        return redirect()->route('posts.index')->with('success', 'Post updated.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post deleted.');
    }
}
