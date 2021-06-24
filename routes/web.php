<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Controllers;

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

Auth::routes();

Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::resource('books', Controllers\BookController::class)->middleware('auth');
Route::resource('authors', Controllers\AuthorController::class)->except('show', 'create')->middleware('auth');
Route::get('book/{book}/authors/create', [Controllers\AuthorController::class, 'create'])->name('author.create')->middleware('auth');
