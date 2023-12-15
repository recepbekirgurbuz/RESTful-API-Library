<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\UserBook;

class UserDetailsController extends Controller
{
    public function userDetails($id) {
        $user = User::select('name', 'surname', 'tel')->find($id);

        $delivery = UserBook::select('book_id', 'user_id', 'status')->where('user_id', $id)->where('status', 'true')->get();

        # $delivery den book_id sütununu aldım ve kitap id'sinden kitap adını çektim
        $deliveryBookIds = $delivery->pluck('book_id');
        $deliveryBookName = Book::select('book_name')->whereIn('id', $deliveryBookIds)->get();

        $deliveryDate = UserBook::select('delivery_date')->where('user_id', $id)->where('status', "false")->get();
        $statusBookIds = UserBook::select('book_id')->where('user_id', $id)->where('status', "false")->get();
        $statusBookName = Book::select('book_name')->whereIn('id', $statusBookIds)->get();

        if($user) {
            return response()->json([
                'success' => true,
                'Kullanıcı Detayları'=> [
                    'Bilgileri'=> $user,
                    'Kullanıcı bu kitabı aldı ve hala teslim etmedi'=> [
                        $deliveryDate,
                        $statusBookName,
                    ],
                    'Daha önce okuduğu kitaplar' => $deliveryBookName,
                ]
            ]);
        }
    }
}
