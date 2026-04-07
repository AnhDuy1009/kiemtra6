<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\MovieController::class, 'index']);
Route::get('/theloai/{id}', [MovieController::class, 'getByGenre'])->name('movie.genre');
Route::get('/movie/{id}', [MovieController::class, 'detail'])->name('detail');
Route::get('/timkiem', [MovieController::class, 'search'])->name('movie.search');

// Trang danh sách quản lý
Route::get('/movies/manage', [MovieController::class, 'adminList'])->name('movie.manage');

// Route cho nút Thêm (Chức năng 4) - Thêm dòng này để hết lỗi
Route::get('/movies/create', [MovieController::class, 'create'])->name('movie.create');

// Route cho nút Xem (Chi tiết)
Route::get('/movies/detail/{id}', [MovieController::class, 'show'])->name('movie.detail');

// Route cho nút Xóa (Xóa mềm)
Route::get('/movies/delete/{id}', [MovieController::class, 'softDelete'])->name('movie.delete');