<?php

namespace App\Http\Controllers\GeneralInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainBodyController extends Controller
{

    public function index()
    {
        return view('general_info.mainbody');
    }
}
