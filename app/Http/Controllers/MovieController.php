<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    // --- PHẦN DÀNH CHO NGƯỜI DÙNG ---

    public function index()
    {
        $genres = Genre::all();

        // Chỉ hiển thị phim có status = 1 (chưa xóa mềm) 
        $movies = Movie::where('status', 1)
            ->where('popularity', '>', 450)
            ->where('vote_average', '>', 7)
            ->orderBy('release_date', 'desc')
            ->limit(12)
            ->get();
        
        $title = "Trang chủ MovieDB";
        return view('movie.index', compact('movies', 'genres', 'title'));
    }

    public function getByGenre($id)
    {
        $genre_active = Genre::findOrFail($id);
        $genre = DB::select("select * from genre"); // Lấy lại danh sách cho menu

        $movies = Movie::whereHas('genres', function ($query) use ($id) {
                $query->where('genre.id', $id);
            })
            ->where('status', 1)
            ->orderBy('release_date', 'desc')
            ->limit(12)
            ->get();

        $title = "Thể loại: " . $genre_active->genre_name_vn;
        return view('movie.movies_by_genre', compact('movies', 'genre', 'genre_active', 'title'));
    }

    public function detail($id)
    {
        $movie = Movie::findOrFail($id);
        $title = $movie->movie_name_vn;
        return view('movie.detail', compact('movie', 'title'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $genre = DB::select("select * from genre");
        
        if (!empty($keyword)) {
            // Câu lệnh lấy phim theo từ khóa và chỉ lấy phim chưa xóa [cite: 17, 29]
            $movies = DB::select("select * from movie where status = 1 and movie_name_vn like ?", ["%".$keyword."%"]);
            $title = "Kết quả tìm kiếm cho: " . $keyword; 
        } else {
            $movies = DB::select("select * from movie where status = 1 limit 12");
            $title = "Tìm kiếm phim";
        }

        return view('search', compact('movies', 'keyword', 'title', 'genre')); 
    }

    // --- PHẦN QUẢN LÝ (ADMIN) ---

    public function adminList() 
    {
        // Truy vấn lấy danh sách phim có status = 1 
        $movies = DB::select("select * from movie where status = 1");
        $genre = DB::select("select * from genre");
        $title = "Quản lý danh sách phim";
        
        return view('movie.list', compact('movies', 'genre', 'title')); 
    }

    public function softDelete($id) 
    {
        // Thực hiện xóa mềm: cập nhật status về 0 
        DB::update("update movie set status = 0 where id = ?", [$id]);
        return redirect()->back()->with('success', 'Đã xóa phim thành công');
    }

    // 1. Hiển thị trang thêm mới (Chức năng 4) [cite: 31]
    public function create() 
    {
        // Phải lấy danh sách thể loại để Menu bên trái hiển thị bình thường
        $genre = DB::select("select * from genre"); 
        $title = "Thêm bộ phim mới";
        return view('movie.create', compact('genre', 'title'));
    }

    // 2. Xử lý lưu phim mới (Chức năng 4) [cite: 31]
    public function store(Request $request) 
    {
        // Kiểm tra dữ liệu và hiển thị lỗi tiếng Việt [cite: 32, 34]
        $request->validate([
            'movie_name' => 'required',
            'movie_name_vn' => 'required',
            'release_date' => 'required|date_format:Y-m-d', // Định dạng yyyy-mm-dd [cite: 35]
            'overview_vn' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra định dạng ảnh [cite: 33]
        ], [
            'required' => ':attribute bắt buộc phải nhập.',
            'image' => 'Tệp tải lên phải là hình ảnh.',
            'mimes' => 'Ảnh đại diện phải có định dạng: jpeg, png, jpg, gif.',
            'date_format' => 'Ngày phát hành phải nhập theo định dạng yyyy-mm-dd.',
        ], [
            'movie_name' => 'Tên tiếng Anh',
            'movie_name_vn' => 'Tên tiếng Việt',
            'release_date' => 'Ngày phát hành',
            'overview_vn' => 'Mô tả',
            'image' => 'Ảnh đại diện',
        ]);

        // Xử lý file ảnh lưu tại storage/app/public [cite: 3, 15]
        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public', $fileName);
        }

        // Câu lệnh SQL thêm phim mới, status mặc định là 1 
        DB::insert("insert into movie (id, movie_name, movie_name_vn, original_name, release_date, overview_vn, image, status) 
                    values (?, ?, ?, ?, ?, ?, ?, ?)", [
            rand(1000000, 9999999), 
            $request->movie_name,
            $request->movie_name_vn,
            $request->movie_name,
            $request->release_date,
            $request->overview_vn,
            '/' . $fileName, 
            1 
        ]);

        return redirect()->route('movie.manage')->with('success', 'Thêm bộ phim mới thành công!');
    }
}