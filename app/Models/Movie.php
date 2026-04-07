<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movie'; // Tên bảng trong file SQL của bạn
    public $timestamps = false; // Vì file SQL không có cột created_at/updated_at chuẩn Laravel

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre', 'id_movie', 'id_genre');
    }
}