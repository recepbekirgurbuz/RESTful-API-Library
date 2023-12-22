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
    public function getAllDelivery()
    {
        // Belirli bir kitaba ait 'status' değeri 'false' olan tüm teslimatları al
        return $this->hasMany(Delivery::class, 'book_id', 'id')
            ->where('status', 'false')
            ->get();
    }

    public function listBooks()
    {
        $books = Book::all();

        if ($books->isNotEmpty()) {
            $responseData = [];

            foreach ($books as $book) {
                $deliveries = $book->getAllDelivery();

                $responseData[] = [
                    'book_id' => $book->id,
                    'book_name' => $book->book_name,
                    'author' => $book->author,
                    'delivery' => $deliveries
                ];
            }

            return response()->json([
                'success' => true,
                'books' => $responseData,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hiç kitap bulunamadı',
            ], 204);
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
        $book = Book::find($id);
        $delivery = $book->getDelivery();

        if ($book) {
            return response()->json([
                'success' => true,
                'book' => $book,
                'kitap_bu_kullanıcıda' => $delivery,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message'=> 'Ödünç kitap bulunamadı'
            ], 204);
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
