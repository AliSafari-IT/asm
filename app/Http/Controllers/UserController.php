<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        // Your logic to fetch users and return a view
        $users = User::all(); // Example fetching all users
        return view('users.index', ['users' => $users]);
    }

    public function show(User $user)
    {
        // Your logic to show a specific user and return a view
        return view('users.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        // Your logic to edit a specific user and return a view
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        // Your logic to update a specific user
        $user->update($request->all());
        return redirect()->route('users.show', $user);
    }

    public function destroy($id)
    {
        // Your logic to delete a specific user
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index') ->with('success', 'User deleted successfully.');
    }

    public function create()
    {
        // Your logic to return a view for creating a new user
        return view('users.create');
    }
}
