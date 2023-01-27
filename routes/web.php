<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminMovieController;
use App\Http\Controllers\ScreeningAdminController;

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




Route::get('/', [MovieController::class, 'index']);

Route::get('/logowanie', [LoginController::class, 'loginView']);
Route::post('/logowanie', [LoginController::class, 'login']);

Route::get('/rejestracja', [RegisterController::class, 'registerView']);
Route::post('/rejestracja', [RegisterController::class, 'register']);

Route::get('/film/{id}', [MovieController::class, 'getMovie']);


Route::group(['middleware' => ['auth']], function(){
    Route::get('/wylogowanie', [LoginController::class, 'logout']);
    Route::post('/rezerwuj-bilety', [MovieController::class, 'makeReservation']);

    Route::get('/moje-rezerwacje', [MovieController::class, 'userReservations']);

    Route::group(['middleware' => [App\Http\Middleware\AdminMiddleware::class]], function(){
        Route::get('/zarzadzanie-filmami', [AdminMovieController::class,'index']);
        Route::get('/dodaj-film', [AdminMovieController::class, 'modify']);
        Route::get('/edytuj-film/{id}', [AdminMovieController::class, 'modify']);
        Route::post('/zapisz-film', [AdminMovieController::class, 'save']);
        Route::get('/usun-film/{id}', [AdminMovieController::class, 'delete']);

        Route::get('/zarzadzanie-seansami/{id}', [ScreeningAdminController::class, 'index']);
        Route::get('/dodaj-seans/{movie_id}', [ScreeningAdminController::class, 'modify']);
        Route::get('/edytuj-seans/{movie_id}/{id}', [ScreeningAdminController::class, 'modify']);
        Route::post('/zapisz-seans', [ScreeningAdminController::class, 'save']);
        Route::get('/usun-seans/{id}', [ScreeningAdminController::class, 'delete']);
    });
});