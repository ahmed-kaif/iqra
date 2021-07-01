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
Route::get('book/{book}/change-image',[Controllers\BookController::class, 'changeImageForm'])->name('change.image.form')->middleware('auth');
Route::post('book/{book}/change-image',[Controllers\BookController::class, 'changeImage'])->name('change.image')->middleware('auth');
Route::resource('authors', Controllers\AuthorController::class)->except('show', 'create')->middleware('auth');
Route::get('book/{book}/authors/create', [Controllers\AuthorController::class, 'create'])->name('author.create')->middleware('auth');
Route::resource('articles', Controllers\ArticleController::class)->middleware('auth');
Route::get('article/{article}/change-image',[Controllers\ArticleController::class, 'changeImageForm'])->name('articles.change.image.form')->middleware('auth');
Route::post('article/{article}/change-image',[Controllers\ArticleController::class, 'changeImage'])->name('articles.change.image')->middleware('auth');
