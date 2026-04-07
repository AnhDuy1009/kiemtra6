@extends('welcome')

@section('content')

<style>
    .banner {
        width: 100%;
        /* max-width: 1200px; (Bạn có thể cân nhắc tắt dòng này đi nếu muốn banner tràn viền toàn màn hình giống ảnh mẫu) */
        max-height: 200px;
        height: 65vh;
        background-image: url("{{ asset('storage/anhbia.jpg') }}");
        background-size: cover;
        background-position: center; /* Thêm dòng này để ảnh không bị lệch */
        color: white;
        margin: 0 auto 20px auto; /* Cách phần nội dung bên dưới ra 20px */
        
        /* Căn giữa chữ Welcome giống ảnh mẫu */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
</style>

<div class="banner">
    <h1 style="font-weight: 700; margin-bottom: 10px;">Welcome.</h1>
    <h3 style="font-weight: 400;">Millions of movies, TV shows and people to discover. Explore now.</h3>
</div>

<div class="container-fluid px-4">
    </div>
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-3 col-lg-2 mb-4">
            <div class="card bg-dark text-white rounded-0 border-0">
                <div class="card-header border-bottom border-secondary py-3">
                    <h6 class="mb-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-film me-2" viewBox="0 0 16 16">
                            <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1zm4 0v6h8V1H4zm8 8H4v6h8V9zM1 1v2h2V1H1zm2 3H1v2h2V4zM1 7v2h2V7H1zm2 3H1v2h2v-2zm-2 3v2h2v-2H1zM15 1h-2v2h2V1zm-2 3v2h2V4h-2zm2 3h-2v2h2V7zm-2 3v2h2v-2h-2zm2 3h-2v2h2v-2z"/>
                        </svg>
                        Thể loại phim
                    </h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-dark text-white border-0 py-2">Phim Hành Động</li>
                    <li class="list-group-item bg-dark text-white border-0 py-2">Phim Phiêu Lưu</li>
                    <li class="list-group-item bg-dark text-white border-0 py-2">Phim Hoạt Hình</li>
                    <li class="list-group-item bg-dark text-white border-0 py-2">Phim Hài</li>
                    <li class="list-group-item bg-dark text-white border-0 py-2">Phim Hình Sự</li>
                    <li class="list-group-item bg-dark text-white border-0 py-2">Phim Tài Liệu</li>
                    <li class="list-group-item bg-dark text-white border-0 py-2">Phim Chính Kịch</li>
                    <li class="list-group-item bg-dark text-white border-0 py-2">Phim Gia Đình</li>
                    <li class="list-group-item bg-dark text-white border-0 py-2">Phim Giả Tượng</li>
                    <li class="list-group-item bg-dark text-white border-0 py-2">Phim Lịch Sử</li>
                    <li class="list-group-item bg-dark text-white border-0 py-2">Phim Kinh Dị</li>
                    <li class="list-group-item bg-dark text-white border-0 py-2">Phim Nhạc</li>
                    <li class="list-group-item bg-dark text-white border-0 py-2">Phim Bí Ẩn</li>
                </ul>
            </div>
        </div>

        <div class="col-md-9 col-lg-10">
            <h2 class="text-center mb-4" style="font-weight: 400;">DANH SÁCH PHIM</h2>
            
            <a href="{{ route('movie.create') }}" class="btn btn-success mb-3">Thêm</a>

            <table id="id-table" class="table table-bordered table-striped" style="width: 100%;">
                <thead class="bg-light">
                    <tr class="text-center align-middle">
                        <th style="width: 10%;">Ảnh đại diện</th>
                        <th style="width: 25%;">Tiêu đề</th>
                        <th style="width: 35%;">Giới thiệu</th>
                        <th style="width: 10%;">Ngày phát hành</th>
                        <th style="width: 10%;">Điểm đánh giá</th>
                        <th style="width: 10%;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movies as $movie)
                    <tr>
                        <td class="text-center align-middle">
                            <img src="{{ asset('storage/'.$movie->image) }}" alt="Ảnh đại diện" style="max-width: 60px; height: auto;">
                        </td>
                        <td class="align-middle">{{ $movie->movie_name_vn }}</td>
                        <td class="align-middle">{{ Str::limit($movie->overview, 80) }}</td>
                        <td class="text-center align-middle">{{ $movie->release_date }}</td>
                        <td class="text-center align-middle">{{ $movie->vote_average }}</td>
                        <td class="text-center align-middle">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('movie.detail', $movie->id) }}" class="btn btn-primary btn-sm">Xem</a>
                                <a href="{{ route('movie.delete', $movie->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa phim này?')">Xóa</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#id-table').DataTable({
            responsive: true,
            pageLength: 5,          // Đặt số lượng hiển thị là 5
            lengthChange: false,    // Ẩn menu cho phép đổi số lượng hiển thị
            bStateSave: true        // Lưu trạng thái trang hiện tại
        });
    });
</script>
@endpush