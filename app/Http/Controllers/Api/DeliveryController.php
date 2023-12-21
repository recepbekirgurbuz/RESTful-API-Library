<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delivery;

class DeliveryController extends Controller
{
    public function listDeliveries()
    {
        $deliveries = Delivery::all();

        if ($deliveries->isNotEmpty()) {
            $responseData = [];

            foreach ($deliveries as $delivery) {
                $responseData[] = [
                    'delivery_id' => $delivery->id,
                    'point' => $delivery->point,
                    'status' => $delivery->status,
                    'delivery_date' => $delivery->delivery_date,
                    'books' => $delivery->getAllBook,
                    'user' =>  $delivery->getAllUser,
                ];
            }
            return response()->json([
                'success' => true,
                'deliveries' => $responseData,
            ], 200);
        }

        else {
            return response()->json([
                'success' => false,
                'message'=> 'Ödünç kitap bulunamadı'
            ], 204);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createDelivery(Request $request)
    {
        $bookId = $request->book_id;
        $userId = $request->user_id;

        $userDeliveries = Delivery::where('user_id', $userId)
            ->where('status', false)
            ->get();

        $unreturnedDeliveries = Delivery::where('book_id', $bookId)
            ->where('status', false)
            ->get();

        if($userDeliveries->isEmpty()) {

            if ($unreturnedDeliveries->isEmpty()) {
                $delivery = new Delivery();
                $delivery->book_id = $request->book_id;
                $delivery->user_id = $request->user_id;
                $delivery->point = $request->point;
                $delivery->status = $request->status;
                $delivery->delivery_date = $request->delivery_date;

                if ($delivery->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Ödünç alma işlemi başarıyla gerçekleşti',
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Ödünç alma işlemi gerçekleşemedi tekrar deneyin'
                    ], 400);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Kitap teslim edilmediği için alınmaya uygun değil, ödünç alma işlemi gerçekleşemedi'
                ], 400);
            }
        } else {
            return response()->json([
                'success'=> false,
                'message'=> 'Kullanıcının teslim etmediği bir kitap bulunuyor'
            ], 400);
        }
    }

    /**
     * Kullanıcı id ile sorgulama yapılacak
     */
    public function showDelivery($book_id)
    {
        $delivery = Delivery::find($book_id);

        if ($delivery) {
            return response()->json([
                'success' => true,
                'delivery_id' => $delivery->id,
                'delivery_date' => $delivery->delivery_date,
                'status' => $delivery->status,
                'books' => $delivery->getBook,
                'user' =>  $delivery->getUser,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message'=> 'Ödünç kitap bulunamadı'
            ], 204);
        }
    }

    /**
     * Güncellemek veya silmek için sütun id kullanılacak
     */
    public function updateDelivery(Request $request, $id)
    {
        $delivery = Delivery::where('id', $id);
        if($delivery->update($request->all())) {
            return response()->json([
                'success' => true,
                'message' => 'Delivery verileri güncellendi'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Maalesef delivery verileri güncellenemedi'
            ], 400);
        }
    }
}
