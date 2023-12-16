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

        # $delivery den book_id sütununu aldım ve kitap id'sinden kitap adını çektim
        $deliveryTrue = UserBook::select('book_id', 'user_id', 'status')->where('user_id', $id)->where('status', 'true')->get();

        $deliveryBook = Book::select('book_name', 'author')->whereIn('id', $deliveryTrue->pluck('book_id'))->get();
        $point = UserBook::select('point')->whereIn('id', $deliveryTrue->pluck('book_id'))->get();

        $deliveryFalse = UserBook::select('book_id', 'delivery_date')->where('user_id', $id)->where('status', "false")->get();
        $book = Book::select('book_name', 'author')->whereIn('id', $deliveryFalse->pluck('book_id'))->get();

        if($user) {
            return response()->json([
                'success' => true,
                'Kullanıcı Bilgileri'=> $user,
                'Kullanıcı bu kitabı aldı ve hala teslim etmedi' => [
                    'kitap adı' => $book->pluck('book_name'),
                    'son teslim tarihi' => $deliveryFalse->pluck('delivery_date'),
                ],
                'Daha önce okuduğu kitaplar' => [
                    $deliveryBook->pluck('book_name', 'author'),
                ],
            ]);
        }
    }
}
