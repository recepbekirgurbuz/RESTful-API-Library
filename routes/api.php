<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BooksController;
use App\Http\Controllers\Api\UserBooksController;
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
    Route::get('/users', 'index'); // tüm kullanıcıları listeler
    Route::post('/user', 'store'); // yeni kullanıcı ekler
    Route::get('/user/{id}', 'show'); // id ye sahip olan kullanıcıyı listeler
    Route::put('/user/{id}', 'update'); // id ye sahip olan kullanıcı bilgilerini günceller
    Route::delete('/user/{id}','destroy'); // id ye sahip olan kullanıcıyı siler
});

Route::controller(UserBooksController::class)->group(function () {
    Route::get('/deliveries', 'index'); // kitap almış ve alan kişiler
    Route::post('/delivery', 'store'); // kitap alacak kişinin girişi
    Route::get('/delivery/{user_id}', 'show'); // kullanıcı id bilgisinden daha önceki aldığı kitapların hepsini listelemek
    Route::put('/delivery/{id}', 'update'); // bir kullanıcının teslim ettiği kitaba değerlendirme puanı veya teslim tarihini uzatma işlemleri
    Route::delete('/delivery/{id}','destroy'); // id'ye sahip olan kitap teslimatını sil
});

Route::controller(BooksController::class)->group(function () {
    Route::get('/books', 'index'); // kitapların tümünü listele
    Route::post('/book', 'store'); // yeni kitap ekle
    Route::get('/book/{id}', 'show'); // kitap id si ile kitap bilgilerini ve kitabın aldığı ortalama puanı hesaplar ekrana çıktı verir
    Route::put('/book/{id}', 'update'); // kitap id si ile kitap bilgilerini günceller
    Route::delete('/book/{id}', 'destroy'); // kitap id si ile kitap bilgilerini siler
});
