<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Book;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listBooks()
    {
        $allBooks = Book::all();
        if($allBooks->isEmpty()) {
            return response()->json([
                'success'=> false,
                'message'=> 'Üzgünüz, kayıtlı kitap yok'
            ]);
        } else {
            return response()->json([
                'success' => true,
                'Kitaplar' => $allBooks
            ]);
        }

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
        if($book->save()) {
            return response()->json([
                'success' => true,
                'message' => "Kitap başarıyla eklendi"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Maalesef kitap eklenemedi"
            ]);
        }
    }

    /**
     * kitap id si ile kitap bilgilerini çeker
     */
    public function showBook(string $id)
    {
        $book = Book::select('book_name', 'author')->find($id);
        $averagePoint = Delivery::where('book_id', $id)->avg('point');

        $status = Delivery::where('book_id', $id)->where('status', 'false')->get();
        if ($status->isEmpty()) {
            $status = 'Kitap teslim edilmedi, Alınmaya uygun değil';
        } else {
            $status = 'Kitap teslim edilmiş, Alınmaya uygun';
        }

        if($book){
            return response()->json([
                'success' => true,
                'book' => $book,
                'averagePoint' => $averagePoint,
                'delivery_status' => $status
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message'=> 'Üzgünüz böyle bir kitap bulunamadı'
            ]);
        }
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
        if($book->update()){
            return response()->json([
                'success' => true,
                'message' => "kitap bilgileri başarıyla güncellendi"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "kitap bilgileri maalesef güncellenemedi"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteBook(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        if($book->delete()){
            return response()->json([
                'success' => true,
                'message' => "kitap başarıyla silindi"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "kitap silinemedi"
            ]);
        }
    }
}
