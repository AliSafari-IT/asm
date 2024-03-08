<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        // Your logic to fetch users and return a view
        $users = User::all(); // Example fetching all users
        return view('users.index', compact('users'));
    }
}
