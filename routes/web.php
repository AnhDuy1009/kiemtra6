<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\MovieController::class, 'index']);
Route::get('/theloai/{id}', [MovieController::class, 'getByGenre'])->name('movie.genre');
Route::get('/movie/{id}', [MovieController::class, 'detail'])->name('detail');
Route::get('/timkiem', [MovieController::class, 'search'])->name('movie.search');