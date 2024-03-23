<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show($id)
    {
        $comment = \App\Models\Comment::findOrFail($id);
        return view('blog.comments.show', compact('comment'));
    }
}
