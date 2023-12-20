<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Delivery;
class UserController extends Controller
{

    public function listUsers()
    {
        $allUsers = User::all();
        if  ($allUsers) {
            return response()->json([
                'success' => true,
                'Users' => $allUsers
            ], 200);
        } else {
            return response()->json([
                'success'=> false,
                'message'=> 'Böyle bir kullanıcı bulunamadı'
            ], 204);
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
        if($user->save()){
            return response()->json([
                'success' => true,
                'message' => 'Kullanıcı başarıyla kayıt edildi'
            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Kullanıcı kayıt edilemedi'
            ], 400);
        }
    }

    public function showUser($userId)
    {
        $user = User::select('name', 'surname', 'address', 'tel')->find($userId);
        if (!$user) {
            return response()->json(['error' => 'No such user found'], 204);
        }

        $userBooks = Delivery::select('book_name', 'point', 'status')
            ->join('books', 'delivery.book_id', 'books.id')
            ->where('user_id', $userId)
            ->get();

        $userData = [
            'user_info' => $user,
            'books' => $userBooks
        ];

        return response()->json($userData, 200);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->tel = $request->tel;
        $user->address = $request->address;
        $user->email = $request->email;
        if($user->update($request->all())) {
            return response()->json([
                'success' => true,
                'Güncellenen Kullanıcı' => $user
            ], 200);
        } else {
            return response()->json(['error'=> ''], 400);
        }
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'User deleted'
        ], 204);

    }
}
