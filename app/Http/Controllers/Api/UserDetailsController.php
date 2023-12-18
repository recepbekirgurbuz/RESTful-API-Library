<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Delivery;

class UserDetailsController extends Controller
{
    public function userDetails($userId) {
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'Böyle bir kullanıcı yok'], 404);
        }

        $userBooks = Delivery::select('delivery.*', 'books.*')
            ->join('books', 'delivery.book_id', 'books.id')
            ->where('delivery.user_id', $userId)
            ->where('user_id', $userId)
            ->where('delivery.status', 'true')
            ->get();
        $notDelivered = Delivery::select('delivery.*', 'books.*')
            ->join('books', 'delivery.book_id', '=', 'books.id')
            ->where('delivery.user_id', $userId)
            ->where('user_id', $userId)
            ->where('delivery.status', 'false')
            ->get();

        $userData = [
            'user_info' => [
                'user_name' => $user->name,
                'surname' => $user->surname,
                'address' => $user->address,
                'telefon' => $user->tel,
            ],
            'teslim_edilmedi' => $notDelivered->map(function ($userBook) {
                return [
                    'book_name' => $userBook->book_name,
                    'kullanicinin_verdigi_puan' => $userBook->point,
                    'delivery_date' => $userBook->delivery_date,
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

