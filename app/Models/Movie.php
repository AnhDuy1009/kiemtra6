<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movie'; // Tên bảng trong file SQL của bạn
    public $timestamps = false; // Vì file SQL không có cột created_at/updated_at chuẩn Laravel

    protected $fillable = [
        'id',             // Cần thiết vì bảng không để Auto Increment 
        'movie_name',      // Tên tiếng Anh 
        'movie_name_vn',   // Tên tiếng Việt 
        'original_name',   // Tên gốc (có thể dùng chung với movie_name) 
        'release_date',    // Ngày phát hành [cite: 31, 35]
        'overview_vn',     // Mô tả 
        'image',           // Tên file ảnh đại diện [cite: 15, 31]
        'status'           // Trạng thái cho chức năng xóa mềm 
    ];
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre', 'id_movie', 'id_genre');
    }
}