<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:20',
            'surname' => 'required|string|max:20',
            'username' => 'required|string|max:20|unique:users|regex:/^[a-zA-Z0-9_]+$/',
            'user_type_id' => 'required|integer|exists:user_types,id', // 'exists' checks if the value exists in the 'id' column of the 'user_types' table
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|min:8'
        ];

        $validator = \Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json((
                [
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ]
            ), 400);
        }

        $user = User::create([
            'uuid' => \Str::uuid(),
            'name' => $request->name,
            'surname' => $request->surname,
            'username' => $request->username,
            'user_type_id' => $request->user_type_id,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'token' => $user->createToken('authToken')->plainTextToken,
            'data' => $user,

        ], 201);
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string'
        ];

        $validator = \Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json((
                [
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ]
            ), 400);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        return response()->json([
            'success' => true,
            'message' => 'User logged in successfully',
            'token' => $user->createToken('authToken')->plainTextToken,
            'user' => $user,
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ], 200);
    }
}
