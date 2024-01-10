<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Delivery;

class UserController extends Controller
{

    public function listUsers()
    {
        // //$users = User::with(["delivery:id,user_id,book_id"])->get()->toArray();   // belongto

        // $users = User::with(["delivery"=>function($query){
        //     return $query->with(["book"])->select("id", "book_id", "user_id")->orderBy('book_id', 'DESC')->get();
        // }])->get()->toArray();

        //     return response()->json([
        //         $users
        //     ], 200);
        // hasmany
        $users = User::with('books')->get();

        if ($users->isNotEmpty()) {
            $responseData = [];

            foreach ($users as $user) {
                $userBooks = $user->books->pluck('book_name')->toArray();

                $responseData[] = [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'surname' => $user->surname,
                    'email' => $user->email,
                    'tel' => $user->tel,
                    'address' => $user->address,
                    'books' => $userBooks,
                ];
            }

            return response()->json([
                'success' => true,
                'users' => $responseData,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kullanıcı bulunamadı'
            ], 204);
        }
    }

    public function showUser($userId)
    {
        $user = User::with('books')->find($userId);

        if ($user) {
            $userBooks = $user->books->pluck('book_name')->toArray();

            $active = $user->active->pluck('book_name')->toArray();

            $responseData = [
                'user_id' => $user->id,
                'name' => $user->name,
                'surname' => $user->surname,
                'email' => $user->email,
                'tel' => $user->tel,
                'address' => $user->address,
                'books' => $userBooks,
                'active' => $active,
            ];

            return response()->json([
                'success' => true,
                'user' => $responseData,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kullanıcı bulunamadı'
            ], 404);
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
