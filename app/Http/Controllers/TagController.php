<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($id)
    {
        $tag = \App\Models\Tag::findOrFail($id);
        return view('blog.tags.show', compact('tag'));
    }
}
