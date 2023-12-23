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
        // Tüm kitapları al, ve ilişkili teslimatları ön yükle
        $books = Book::with('deliveries.user')->get();

        if ($books->isNotEmpty()) {
            $responseData = [];
            foreach ($books as $book) {
                $deliveriesData = [];
                foreach ($book->deliveries as $delivery) {
                    $deliveriesData[] = [
                        'status' => $delivery->status,
                        'delivery_date' => $delivery->delivery_date,
                        'user_id' => $delivery->user->id,
                        'name' => $delivery->user->name,
                        'surname' => $delivery->user->surname,
                    ];
                }

                $responseData[] = [
                    'book_id' => $book->id,
                    'book_name' => $book->book_name,
                    'deliveries' => $deliveriesData,
                ];
            }

            return response()->json([
                'success' => true,
                'books' => $responseData,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kayıtlı kitap yok',
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
    public function showBook($deliveryId)
    {
        $delivery = Delivery::find($deliveryId);

        $deliveringUser = $delivery->user;
        $deliveredBook = $delivery->book;

        return response()->json([
            'success' => true,
            'book_name' => $deliveredBook->book_name,
            'author' => $deliveredBook->author,
            'delivery' => [
                'user_id' => $deliveringUser->id,
                'name' => $deliveringUser->name,
                'surname' => $deliveringUser->surname,
            ]
        ], 200);
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
