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
        $allBooks = Book::select('book_name', 'author')->get();

        if($allBooks->isEmpty()) {
            return response()->json([
                'success'=> false,
                'message'=> 'Üzgünüz, kayıtlı kitap yok'
            ], 204);
        } else {
            return response()->json([
                'success' => true,
                'Kitaplar' => $allBooks,
            ], 200);
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
        if($book->save()) {
            return response()->json([
                'success' => true,
                'message' => "Kitap başarıyla eklendi"
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Maalesef kitap eklenemedi"
            ], 400);
        }
    }

    /**
     * kitap id si ile kitap bilgilerini çeker
     */
    public function showBook($id)
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
    public function updateBook(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->book_name = $request->book_name;
        $book->author = $request->author;
        if($book->update($request->all())){
            return response()->json([
                'success' => true,
                'message' => "kitap bilgileri başarıyla güncellendi"
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "kitap bilgileri maalesef güncellenemedi"
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
    */
    public function deleteBook($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        if($book->delete()){
            return response()->json([
                'success' => true,
                'message' => "kitap başarıyla silindi"
            ], 204);
        } else {
            return response()->json([
                'success' => false,
                'message' => "kitap silinemedi"
            ], 400);
        }
    }
}
