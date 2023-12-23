<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'id';

    public function getAllDelivery() {
        return $this->hasMany(Delivery::class, 'user_id')->where('status', 'false');
    }
}
