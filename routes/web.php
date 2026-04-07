<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\MovieController::class, 'index']);
// Route hiển thị phim theo thể loại
Route::get('/theloai/{id}', [MovieController::class, 'getByGenre'])->name('movie.genre');
