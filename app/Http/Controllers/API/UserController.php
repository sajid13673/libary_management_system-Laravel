<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterPostRequest;
use App\Models\User;
use domain\Facades\UserFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $adminScopes = ['manage-books', 'manage-members', 'manage-borrowings'];
        $memberScopes = ['read-books'];
        // Data validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        // Auth Facade
        if (Auth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ])) {

            $user = Auth::user();
            if ($user->role == "admin") {
                $token = $user->createToken("myToken", $adminScopes)->accessToken;
            } else {
                $token = $user->createToken("myToken", $memberScopes)->accessToken;
            }

            return response()->json([
                "status" => true,
                "message" => "Login successful",
                "access_token" => $token,
                "role" => $user->role,
            ]);
        }

        return response()->json([
            "status" => false,
            "message" => "Invalid credentials"
        ],500);
    }

    // Profile API (GET)
    public function profile()
    {

        $user = Auth::user();
        $userdata = $user->load(['member'=>['borrowing.book']]);


        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "data" => $userdata
        ]);
    }

    // Logout API (GET)
    public function logout()
    {

        auth()->user()->token()->revoke();

        return response()->json([
            "status" => true,
            "message" => "User logged out"
        ]);
    }
    public function register(RegisterPostRequest $request)
    {
        $user = new User();
        $user = $user->create(['email' => $request->email, 'password' => bcrypt($request->password)]);
        $user->member()->create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    }
}
