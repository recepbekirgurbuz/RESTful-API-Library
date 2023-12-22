<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $primaryKey = 'id';

    public function getAllDelivery() {
        $deliveries = $this->hasMany(Delivery::class, 'book_id', 'id')
            ->where('status', 'false')
            ->get();

        $userNames = [];

        foreach ($deliveries as $delivery) {
            $user = User::find($delivery->user_id);

            if ($user) {
                $userNames[] = $user->name;
            }
        }

        return $userNames;
    }


    public function getDelivery() {
        $delivery = $this->hasOne(Delivery::class, 'book_id', 'id')
            ->where('status', 'false')
            ->first();
        if ($delivery) {
            $user = User::find($delivery->user_id);

            if ($user) {
                return $user->name;
            }
        }
        return null;
    }
}
