<?php

namespace App\Http\Controllers\GeneralInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('general_info.about');
    }
}
