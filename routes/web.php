<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PromoController;

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
    return 'Hello World!';
});


Route::get('/auth', [AuthController::class, 'index']);
Route::get('/comments', [CommentController::class, 'index']);
Route::get('/favorite', [FavoriteController::class, 'index']);
Route::get('/films', [FilmController::class, 'index']);
Route::get('/genres', [GenreController::class, 'index']);
Route::get('/promo', [PromoController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);


