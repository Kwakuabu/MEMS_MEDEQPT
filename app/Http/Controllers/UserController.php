<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        // Show the form for creating a new user
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validate and create a new user
    }

    public function show(User $user)
    {
        // Show a specific user
    }

    public function edit(User $user)
    {
        // Show the form for editing a user
    }

    public function update(Request $request, User $user)
    {
        // Validate and update the user
    }

    public function destroy(User $user)
    {
        // Delete a user
    }
}
