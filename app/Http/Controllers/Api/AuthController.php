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
            return redirect("home")->with('login', 'logged in');
        }
        else {
        // login fail
            return redirect()->back()->with('login','login failed');
        }
    }

    /*
        Register
    */
    public function register(Request $request) {
        User::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'address' => $request->input('address'),
            'tel' => $request->input('tel'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect('login')->with('register', 'registered');
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

        return redirect(route('login'))->with('login', 'logged out');
    }
}
