<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function listUsers()
    {
        $allUsers = User::all();
        if  ($allUsers) {
            return response()->json([
                'success' => true,
                'Kullanıcılar' => $allUsers
            ]);
        } else {
            return response()->json([
                'success'=> false,
                'message'=> 'Kullanıcı oluşturulmamış'
            ]);
        }
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
        if($user->save()){
            return response()->json([
                'success' => true,
                'message' => 'Kullanıcı başarıyla kayıt edildi'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Kullanıcı kayıt edilemedi'
            ]);
        }
    }

    public function showUser($id)
    {
        $user = User::find($id);
        if  ($user) {
            return response()->json([
                'success' => true,
                'Kullancı Bilgileri' => $user
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'böyle bir kullanıcı mevcut değil'
            ]);
        }
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
        return response()->json([
            'success' => true,
            'Güncellenen Kullanıcı' => $user
        ]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'Kullanıcı başarıyla silindi'
        ]);

    }
}
