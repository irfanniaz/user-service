<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\UserRegistered;
use App\Models\User;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
            'password' => 'required|string',
        ]);
        // Save user data
        $user = User::create($validatedData);

        // Dispatch event
        event(new UserRegistered($user));

        return response()->json(['message' => 'User created successfully'], 201);
    }
}
