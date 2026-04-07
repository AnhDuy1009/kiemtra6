<x-movie-layout>
    <x-slot name="title">
        Chi tiết phim - {{ $movie->movie_name_vn }}
    </x-slot>

    <style>
        .detail-content {
            background-color: #fff;
            padding: 20px 30px;
            color: #333;
            font-family: Arial, sans-serif;
        }
        .detail-title {
            font-size: 24px;
            font-weight: normal;
            color: #333;
            margin-bottom: 20px;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 15px;
        }
        .detail-body {
            display: flex;
            gap: 30px;
        }
        .detail-poster {
            width: 300px;
            flex-shrink: 0;
        }
        .detail-poster img {
            width: 100%;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        .detail-info {
            flex-grow: 1;
        }
        .info-line {
            font-size: 15px;
            margin-bottom: 10px;
            color: #222;
        }
        .info-line strong {
            display: inline-block;
            font-weight: bold;
        }
        .desc-label {
            font-weight: bold;
            font-size: 15px;
            margin-top: 15px;
            margin-bottom: 8px;
            color: #000;
        }
        .desc-text {
            font-size: 14px;
            line-height: 1.6;
            color: #444;
            text-align: justify;
            margin-bottom: 20px;
        }
        .btn-trailer {
            display: inline-block;
            background-color: #28a745; /* Màu xanh lá chuẩn bootstrap */
            color: white;
            padding: 8px 20px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 14px;
        }
        .btn-trailer:hover {
            background-color: #218838;
            color: white;
        }
    </style>

    <div class="detail-content">
        <h2 class="detail-title">{{ $movie->movie_name_vn }} - {{ $movie->original_name ?? $movie->movie_name }}</h2>
        
        <div class="detail-body">
            <div class="detail-poster">
                <img src="{{ $movie->image_link ?? asset('storage/' . $movie->image) }}" alt="{{ $movie->movie_name_vn }}">
            </div>
            
            <div class="detail-info">
                <div class="info-line">Ngày phát hành: <strong>{{ $movie->release_date }}</strong></div>
                <div class="info-line">Quốc gia: <strong>{{ $movie->country ?? 'United States of America' }}</strong></div>
                <div class="info-line">Thời gian: <strong>{{ $movie->runtime ?? '119' }} phút</strong></div>
                <div class="info-line">Doanh thu: <strong>{{ $movie->revenue ?? '208' }} triệu USD</strong></div>
                
                <div class="desc-label">Mô tả:</div>
                <div class="desc-text">
                    {{ $movie->overview_vn ?? $movie->overview ?? 'Đang cập nhật nội dung mô tả cho bộ phim này...' }}
                </div>
                
                @if(!empty($movie->trailer) || !empty($movie->trailer_link))
                    <a href="{{ $movie->trailer ?? $movie->trailer_link }}" target="_blank" class="btn-trailer">Xem trailer</a>
                @else
                    <a href="#" class="btn-trailer">Xem trailer</a>
                @endif
            </div>
        </div>
    </div>
</x-movie-layout>