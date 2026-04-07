<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    //
    public function index()
    {
        $genres = \App\Models\Genre::all();

        $movies = Movie::where('popularity', '>', 450)
            ->where('vote_average', '>', 7)
            ->orderBy('release_date', 'desc')
            ->limit(12)
            ->get();
        return view('movie.index', compact('movies', 'genres'));
    }

    public function getByGenre($id)
    {
        // 1. Tìm thể loại dựa trên ID truyền vào
        $genre = Genre::findOrFail($id);

        // 2. Lấy các phim thuộc thể loại này
        // - Sử dụng quan hệ 'movies' từ Model Genre (cần định nghĩa ngược lại trong Genre Model)
        // - Hoặc sử dụng whereHas để lọc phim
        $movies = Movie::whereHas('genres', function ($query) use ($id) {
            $query->where('genre.id', $id);
        })
            ->orderBy('release_date', 'desc')  // Sắp xếp giảm dần theo ngày phát hành
            ->limit(12)  // Giới hạn 12 bộ phim
            ->get();

        // 3. Trả về view kèm theo danh sách phim và thông tin thể loại để hiển thị tiêu đề
        return view('movie.movies_by_genre', compact('movies', 'genre'));
    }

    // Bổ sung hàm này vào MovieController
    public function detail($id)
    {
        // Lấy thông tin phim theo ID
        $movie = \App\Models\Movie::findOrFail($id);

        // Trả về view detail.blade.php mà bạn vừa làm
        return view('movie.detail', compact('movie'));
    }
}
