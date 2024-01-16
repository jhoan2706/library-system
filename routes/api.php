<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('jwt.verify');

Route::middleware('auth:api')->get('/user/role', function (Request $request) {
    return $request->user()->role;
});

Route::middleware('jwt.verify')->group(function () {
    Route::resource('books', BookController::class);

    // Borrow a book
    Route::post('books/{id}/borrow', [BorrowingController::class, 'borrowBook'])->name('books.borrow');

    // Return a borrowed book
    Route::post('borrowings/{id}/return', [BorrowingController::class, 'returnBook'])->name('books.return');

    Route::get('books/search', [BookController::class, 'search'])->name('books.search');
});
