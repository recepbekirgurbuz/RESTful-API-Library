<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /*
        Login
    */
    public function login(Request $request) {
        $data = $request->only('email', 'password');

        if(Auth::attempt($data)) {
        // login success
            return response()->json([
                'success' => true,
                'message' => 'Logged in'
            ], 201);
        }
        else {
        // login fail
            return response()->json([
                'success' => false,
                'message' => 'Login failed'
            ], 401);
        }
    }

    /*
        Register
    */
    public function register(Request $request) {

        User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'tel' => $request->tel,
            'address' => $request->address,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
        ], 201);
    }



    /*
        Logout
    */
    public function logout(Request $request) {
        Auth::logout();
        if(Auth::user()) {
            return response()->json([
                'status'=> 'true',
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'Logged out',
        ], 201);
    }
}
