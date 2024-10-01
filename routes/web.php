<?php

use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// redirect
Route::get('redirect-url', [ShortUrlController::class, 'redirectUrl'])->name('url.redirect');
//
Route::middleware(['auth'])->group(function () {
    Route::get('short-url-list', [ShortUrlController::class, 'index'])->name('shortUrl');
    Route::post('shorten', [ShortUrlController::class, 'store'])->name('shortUrl.store');
    Route::get('delete/{id}', [ShortUrlController::class, 'delete'])->name('shortUrl.delete');
});
//
