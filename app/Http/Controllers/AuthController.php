<?php

namespace App\Http\Controllers;

// Import the User model to interact with the users table
use App\Models\User;

// Import Request to receive data sent from Postman or the frontend
use Illuminate\Http\Request;

// Import Hash to check entered passwords against stored hashed passwords
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // REGISTER API
    // This function creates a new user account
    public function register(Request $request)
    {
        //Validate the information sent by the user
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => ['required','string','min:3','max:20', 'regex:/^[a-zA-Z0-9]+$/','unique:users,username',],
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:artist,gallery',
            'date_of_birth' => 'required|date|before:today',
        ],
        [
            'username.required' => 'Please enter a username.',
            'username.min' => 'Your username must contain at least 3 characters.',
            'username.max' => 'Your username cannot exceed 20 characters.',
            'username.regex' => 'Username can only contain letters and numbers.',
            'username.unique' => 'This username is already taken. Please choose another one.',
        ]);

        // stores validated details into user creation instance
        $user = User::create($validated);

        // creates token and converts it into plain text to send to the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // 4. Return a JSON response containing the user and token
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // LOGIN API
    // This function authenticates an existing user
    public function login(Request $request)
    {
        // Validate the login information
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Find the user using their email address submitted
        $user = User::where('email', $validated['email'])->first();

        // Check if the user exists and if entered password matches the hashed password in db
        if (!$user || !Hash::check($validated['password'], $user->password)) {

            // If the credentials are incorrect, return an error
            return response()->json([
                'message' => 'Invalid email or password',
            ], 401);
        }

        //Generate a Sanctum token for the existing user
        $token = $user->createToken('auth_token')->plainTextToken;

        //Return a successful login response
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ], 200);
    }


    // LOGOUT API
    // This function logs out the authenticated user
    public function logout(Request $request)
    {
        // Delete the user's current authentication token
        $request->user()->currentAccessToken()->delete();

        // Return a success message
        return response()->json([
            'message' => 'Logged out successfully',
        ], 200);
    }


    // GET AUTHENTICATED USER API
    // This function retrieves the currently logged-in user
    public function user(Request $request)
    {
        // Retrieve the authenticated user's details
        return response()->json([
            'user' => $request->user(),
        ], 200);
    }


}
