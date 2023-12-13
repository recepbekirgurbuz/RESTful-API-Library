<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function listUsers()
    {
        $allusers = User::all();
        return $allusers;
    }

    public function createUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->tel = $request->tel;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->save();
    }

    public function showUser($id)
    {
        $user = User::find($id);
        return $user;
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->tel = $request->tel;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->update($request->all());
        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $user;
    }
}
