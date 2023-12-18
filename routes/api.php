<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BooksController;
use App\Http\Controllers\Api\DeliveryController;
use App\Http\Controllers\Api\UserDetailsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'listUsers');
    Route::post('/user', 'createUser');
    Route::get('/user/{id}', 'showUser');
    Route::put('/user/{id}', 'updateUser');
    Route::delete('/user/{id}','deleteUser');
});

Route::controller(DeliveryController::class)->group(function () {
    Route::get('/deliveries', 'listDeliveries');
    Route::post('/delivery', 'createDelivery');
    Route::get('/delivery/{book_id}', 'showDelivery');
    Route::put('/delivery/{id}', 'updateDelivery');
    Route::delete('/delivery/{id}','deleteDelivery');
});

Route::controller(BooksController::class)->group(function () {
    Route::get('/books', 'listBooks');
    Route::post('/book', 'addBook');
    Route::get('/book/{id}', 'showBook');
    Route::put('/book/{id}', 'updateBook');
    Route::delete('/book/{id}', 'deleteBook');
});

Route::controller(UserDetailsController::class)->group(function () {
    Route::get('/userdetails/{id}', 'userDetails');
});
