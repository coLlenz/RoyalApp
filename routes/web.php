<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guests')->group(function () {
	Route::get('login', [AuthController::class, 'login'])->name('auth.login');
	Route::post('login', [AuthController::class, 'loginStore'])->name('auth.login.store');
});

Route::middleware('sauth')->group(function () {
	Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
	Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
	Route::get('authors', [AuthorController::class, 'index'])->name('author.index');
	Route::get('author/{id}', [AuthorController::class, 'show'])->name('author.show');
	Route::get('author/create', [AuthorController::class, 'create'])->name('author.create');
	Route::post('author/store', [AuthorController::class, 'store'])->name('author.store');
	Route::delete('author/delete/{id}', [AuthorController::class, 'delete'])->name('author.delete');
	
	Route::get('books', [BookController::class, 'index'])->name('book.index');
	Route::get('book/create/{aid?}', [BookController::class, 'create'])->name('book.create');
	Route::post('book/store', [BookController::class, 'store'])->name('book.store');
	Route::delete('book/delete/{id}', [BookController::class, 'delete'])->name('book.delete');
});