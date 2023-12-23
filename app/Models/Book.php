<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $primaryKey = 'id';

    public function deliveries()
    {
        return $this->hasMany(Delivery::class, 'book_id')->where('status', 'false');
    }
}
