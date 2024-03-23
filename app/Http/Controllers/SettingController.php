<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function show($id)
    {
        $setting = \App\Models\Setting::findOrFail($id);
        return view('blog.settings.show', compact('setting'));
    }
}
