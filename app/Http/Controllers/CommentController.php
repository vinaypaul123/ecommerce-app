<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
            'body' => $request->body,
        ]);

        return back()->with('success', 'Comment added.');
    }
}
