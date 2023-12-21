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
        return $this->hasMany(Delivery::class, 'user_id', 'id')
        ->select('book_id', 'user_id', 'point', 'status', 'delivery_date')
        ->where('status', 'false');
    }
}
