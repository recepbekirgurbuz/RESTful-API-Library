<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserBook;

class UserDetailsController extends Controller
{
    public function userDetails() {
        User::select('name', 'surname')->get();
        UserBook::select('book_id', 'user_id')->get();
    }
}
