<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserBook;
use App\Models\Book;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listBooks()
    {
        $allbooks = Book::all();
        return $allbooks;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addBook(Request $request)
    {
        $book = new Book();
        $book->book_name = $request->book_name;
        $book->author = $request->author;
        $book->save();
    }

    /**
     * kitap id si ile kitap bilgilerini çeker
     */
    public function showBook(string $id)
    {
        $book = Book::find($id);
        $averagePoint = UserBook::where('book_id', $id)->avg('point');
        return [
            'book' => $book,
            'averagePoint' => $averagePoint,
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateBook(Request $request, string $id)
    {
        $book = Book::findOrFail($id);
        $book->book_name = $request->book_name;
        $book->author = $request->author;
        $book->update($request->all());
        return $book;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteBook(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return $book;
    }
}
