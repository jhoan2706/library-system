<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use Tymon\JWTAuth\Http\Middleware\Authenticate;

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
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');

Route::get('books', [BookController::class, 'booksIndexPage'])->name('books.index');
Route::get('books/add', [BookController::class, 'AddPage'])->name('books.add');
Route::get('books/edit/{id}', [BookController::class, 'editPage'])->name('books.edit');

Route::get('books/search', [BookController::class, 'searchPage'])->name('books.search');

// Routes accessible only to librarians
Route::middleware(['auth', 'librarian'])->group(function () {
    Route::get('librarian/dashboard', [DashboardController::class, 'librarianDashboard'])
        ->name('librarian.dashboard');
    Route::get('books/create', [BookController::class, 'create'])->name('books.create');
    Route::get('books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::post('books', [BookController::class, 'store'])->name('books.store');
    Route::put('books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
});

Route::middleware(['jwt.bearer', 'member'])->group(function () {
    Route::get('member/dashboard', [DashboardController::class, 'memberDashboard'])
        ->name('member.dashboard');
});
