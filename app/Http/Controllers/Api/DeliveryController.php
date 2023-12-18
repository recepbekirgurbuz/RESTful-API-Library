<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Delivery;

class DeliveryController extends Controller
{
    public function listDeliveries()
    {
        $allDelivery = Delivery::all();
        if  ($allDelivery) {
            return response()->json([
                'success' => true,
                'Ödünç Alınmış ve Alınan Kitaplar' => $allDelivery
            ]);
        } else {
            return response()->json([
                'success'=> false,
                'message'=> 'Ödünç kitap alınmamış'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createDelivery(Request $request)
    {
        $delivery = new Delivery();
        $delivery->book_id = $request->book_id;
        $delivery->user_id = $request->user_id;
        $delivery->point = $request->point;
        $delivery->delivery_date = $request->delivery_date;
        $delivery->save();
        if($delivery->save()){
            return response()->json([
                'success' => true,
                'message' => 'Ödünç alma işlemi başarıyla gerçekleşti'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ödünç alma işlemi gerçekleşemedi'
            ]);
        }
    }

    /**
     * Kullanıcı id ile sorgulama yapılacak
     */
    public function showDelivery(string $book_id)
    {
        $delivery = Delivery::select('book_id', 'user_id', 'point', 'status', 'delivery_date')->where('book_id', $book_id)->get();
        if($delivery){
            return response()->json([
                'success' => true,
                'Kitabı alan kullanıcılar' => $delivery,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message'=> 'Ödünç kitap bulunamadı'
            ]);
        }
    }

    /**
     * Güncellemek veya silmek için sütun id kullanılacak
     */
    public function updateDelivery(Request $request, string $id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->book_id = $request->book_id;
        $delivery->user_id = $request->user_id;
        $delivery->point = $request->point;
        $delivery->delivery_date = $request->delivery_date;
        $delivery->update($request->all());
        if($delivery->update()) {
            return response()->json([
                'success' => true,
                'message' => 'Delivery verileri güncellendi'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Maalesef delivery verileri güncellenemedi'
            ]);
        }
    }

    /**
     * Güncellemek veya silmek için sütun id kullanılacak
     */
    public function deleteDelivery(string $id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->delete();
        if($delivery->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Bu ödünç alınan kitap kaydı silindi'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ödünç alınan kitap kaydı silinemedi'
            ]);
        }
    }
}
