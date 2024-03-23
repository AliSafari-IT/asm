<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($id)
    {
        $post = \App\Models\Post::findOrFail($id);
        return view('blog.posts.show', compact('post'));
    }

    public function index()
    {
        $posts = \App\Models\Post::all();
        // {{-- resources/views/blog/posts/index.blade.php --}}
        $view = 'blog.posts.index';
        return view($view, compact('posts'));
    }
}
