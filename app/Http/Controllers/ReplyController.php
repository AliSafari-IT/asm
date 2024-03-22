<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function show($id)
    {
        $reply = \App\Models\Reply::findOrFail($id);
        return view('replies.show', compact('reply'));
    }
}
