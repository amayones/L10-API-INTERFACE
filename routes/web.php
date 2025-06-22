<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

Route::get('/book', [BookController::class, 'index'])->name('book.index');
Route::post('/book', [BookController::class, 'store'])->name('book.store');

Route::get('/book/{id}', [BookController::class, 'edit'])->name('book.edit');
Route::put('/book/{id}', [BookController::class, 'update'])->name('book.update');

Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy');
