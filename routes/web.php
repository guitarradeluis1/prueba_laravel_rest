<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\booksController;

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

Route::post('books/create/{isbn}', [booksController::class, 'create']);
Route::post('books/delete/{isbn}', [booksController::class, 'delete']);
Route::get('books/{isbn}', [booksController::class, 'books']);
Route::get('books/', [booksController::class, 'index']);
Route::get('/', [booksController::class, 'index']);
/*
POST (CREAR): /api/books/create/{isbn}
POST (ELIMINAR): /api/books/delete/{isbn}
GET (LISTAR): /api/books/
GET (VER DETALLE): /api/books/{isbn}
*/