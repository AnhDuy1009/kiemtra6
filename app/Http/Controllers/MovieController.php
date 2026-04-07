<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
   
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
    
        $genre = Genre::findOrFail($id);

        $movies = Movie::whereHas('genres', function ($query) use ($id) {
            $query->where('genre.id', $id);
        })
            ->orderBy('release_date', 'desc')  
            ->limit(12)  
            ->get();

        return view('movie.movies_by_genre', compact('movies', 'genre'));
    }

    public function detail($id)
    {
        $movie = \App\Models\Movie::findOrFail($id);

        return view('movie.detail', compact('movie'));
    }


    public function search(Request $request)
    {
        // Lấy từ khóa người dùng nhập vào từ form
        $keyword = $request->input('keyword');
        $movies = [];
        $title = "Tìm kiếm phim"; 

        // Lấy danh sách thể loại phim để hiển thị ở thanh Menu bên trái
        $genre = DB::select("select * from genre");

        if (!empty($keyword)) {
            $movies = DB::select("select * from movie where movie_name_vn like ?", ["%".$keyword."%"]);
            $title = "Kết quả tìm kiếm cho: " . $keyword; 
        } else {
            $movies = DB::select("select * from movie limit 12");
        }

        // Nhớ bổ sung thêm biến 'genre' vào hàm compact
        return view('search', compact('movies', 'keyword', 'title', 'genre')); 
    }
}