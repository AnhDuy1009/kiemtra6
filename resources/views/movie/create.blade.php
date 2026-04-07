<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm phim mới</title>
    <link rel="stylesheet" href="{{ asset('library/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body { background-color: #f8f9fa; }
        /* Tái tạo Banner xanh theo mẫu */
        .banner {
           width: 100%;
    /* max-width: 1200px; Bỏ dòng này để banner tràn hết chiều ngang như mẫu */
    height: 200px;
    /* asset('storage/...') sẽ trỏ vào thư mục public/storage bạn vừa tạo link */
    background-image: url('{{ asset('storage/anhbia.jpg') }}'); 
    background-size: cover;
    background-position: center;
    color: white;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
        }
        .search-container { width: 80%; margin-top: 15px; position: relative; }
        .search-input { width: 100%; border-radius: 20px; border: none; padding: 10px 100px 10px 20px; }
        .search-btn { 
            position: absolute; right: 5px; top: 5px; bottom: 5px; 
            border-radius: 15px; border: none; background: #00e5ff; color: white; padding: 0 15px;
        }
        /* Tái tạo Menu đen bên trái */
        .sidebar { background-color: #1a1a1a; color: white; min-height: 80vh; border-radius: 4px; padding: 0; }
        .sidebar-header { padding: 15px; border-bottom: 1px solid #333; font-weight: bold; }
        .sidebar-item { 
            padding: 10px 15px; border-bottom: 1px solid #222; display: block; 
            color: #ccc; text-decoration: none; transition: 0.3s;
        }
        .sidebar-item:hover { background-color: #333; color: white; text-decoration: none; }
        /* Nội dung form */
        .form-container { background: white; padding: 25px; border-radius: 4px; border: 1px solid #ddd; }
        .title-blue { color: #0056b3; font-weight: bold; margin-bottom: 25px; text-transform: uppercase; }
        label { font-weight: 600; margin-bottom: 5px; }
        .error-msg { color: red; font-size: 0.85rem; margin-top: 4px; display: block; }
    </style>
</head>
<body>

    <header class="banner">
        <h2>Welcome.</h2>
        <h5>Millions of movies, TV shows and people to discover. Explore now.</h5>
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Nhập tên bộ phim yêu thích để tìm kiếm">
            <button class="search-btn">Tìm kiếm</button>
        </div>
    </header>

    <div class="container-fluid" style="max-width: 1200px;">
        <div class="row">
            <div class="col-md-3">
                <div class="sidebar shadow-sm">
                    <div class="sidebar-header"><i class="fa fa-film"></i> Thể loại phim</div>
                    <a href="#" class="sidebar-item">Phim Hành Động</a>
                    <a href="#" class="sidebar-item">Phim Phiêu Lưu</a>
                    <a href="#" class="sidebar-item">Phim Hoạt Hình</a>
                    <a href="#" class="sidebar-item">Phim Hài</a>
                    <a href="#" class="sidebar-item">Phim Hình Sự</a>
                    <a href="#" class="sidebar-item">Phim Tài Liệu</a>
                    <a href="#" class="sidebar-item">Phim Chính Kịch</a>
                    <a href="#" class="sidebar-item">Phim Gia Đình</a>
                </div>
            </div>

            <div class="col-md-9">
                <div class="form-container shadow-sm">
                    <h3 class="text-center title-blue">THÊM PHIM</h3>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('movie.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label>Tên tiếng Anh</label>
                            <input type="text" name="movie_name" class="form-control" value="{{ old('movie_name') }}">
                            @error('movie_name') <span class="error-msg">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Tên tiếng Việt</label>
                            <input type="text" name="movie_name_vn" class="form-control" value="{{ old('movie_name_vn') }}">
                            @error('movie_name_vn') <span class="error-msg">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Ngày phát hành (yyyy-mm-dd)</label>
                            <input type="text" name="release_date" class="form-control" placeholder="2024-01-01" value="{{ old('release_date', '2024-01-01') }}">
                            @error('release_date') <span class="error-msg">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Mô tả</label>
                            <textarea name="overview_vn" class="form-control" rows="4">{{ old('overview_vn') }}</textarea>
                            @error('overview_vn') <span class="error-msg">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label>Ảnh đại diện</label>
                            <input type="file" name="image" class="form-control">
                            @error('image') <span class="error-msg">{{ $message }}</span> @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-4">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('library/jquery-3.7.1.js') }}"></script>
    <script src="{{ asset('library/bootstrap.bundle.min.js') }}"></script>
</body>
</html>