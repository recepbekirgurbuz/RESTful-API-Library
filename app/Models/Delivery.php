<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $table = 'delivery';
    protected $primaryKey = 'id';

    public function getAllBook() {
        return $this->hasMany(Book::class,'id','book_id')->select('id', 'book_name', 'author');
    }
    public function getAllUser() {
        return $this->hasMany(User::class, 'id', 'user_id')->select('id', 'name', 'surname', 'address', 'tel', 'email');
    }

    public function getBook() {
        return $this->hasOne(Book::class, 'id', 'book_id')->select('id', 'book_name', 'author');
    }

    public function getUser() {
        return $this->hasOne(User::class, 'id', 'user_id')->select('id', 'name', 'surname', 'address', 'tel', 'email');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
