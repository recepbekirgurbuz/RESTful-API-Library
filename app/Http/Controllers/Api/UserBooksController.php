<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\UserBook;
use Illuminate\Http\Request;

class UserBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allbooks = Book::all();
        return $allbooks;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = new Book();
        $book->book_id = $request->book_id;
        $book->user_id = $request->user_id;
        $book->point = $request->point;
        $book->delivery_date = $request->delivery_date;
        $book->save();
    }

    /**
     * Kullanıcı id ile sorgulama yapılacak
     */
    public function show(string $user_id)
    {
        $book = UserBook::where('user_id', $user_id)->get();
        return $book;
    }

    /**
     * Güncellemek veya silmek için sütun id kullanılacak
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);
        $book->book_id = $request->book_id;
        $book->user_id = $request->user_id;
        $book->point = $request->point;
        $book->delivery_date = $request->delivery_date;
        $book->update($request->all());
        return $book;
    }

    /**
     * Güncellemek veya silmek için sütun id kullanılacak
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return $book;
    }
}
