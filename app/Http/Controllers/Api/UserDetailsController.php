<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\UserBook;

class UserDetailsController extends Controller
{
    public function userDetails($userId) {
        // Kullanıcı bilgilerini çek
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'Böyle bir kullanıcı yok'], 404);
        }

        $userBooks = UserBook::select('user_books.*', 'books.*')
            ->join('books', 'user_books.book_id', 'books.id')
            ->where('user_books.user_id', $userId)
            ->where('user_id', $userId)
            ->where('user_books.status', 'true')
            ->get();
        $notDelivered = UserBook::select('user_books.*', 'books.*')
            ->join('books', 'user_books.book_id', '=', 'books.id')
            ->where('user_books.user_id', $userId)
            ->where('user_id', $userId)
            ->where('user_books.status', 'false')
            ->get();

        $userData = [
            'user_info' => [
                'user_name' => $user->name,
                'surname' => $user->surname,
                'address' => $user->address,
                'telefon' => $user->tel,
            ],
            'telim_edilmedi' => $notDelivered->map(function ($userBook) {
                return [
                    'book_name' => $userBook->book_name,
                    'kullanicinin_verdigi_puan' => $userBook->point,
                ];
            }),
            'teslim_edilen_onceki_kitaplar' => $userBooks->map(function ($userBook) {
                return [
                    'book_name' => $userBook->book_name,
                    'kullanicinin_verdigi_puan' => $userBook->point,
                ];
            }),
        ];

        return response()->json($userData);
    }
}

