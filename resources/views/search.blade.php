@component('components.movie-layout', ['title' => $title, 'genre' => $genre])

    <div class="list-movie">
        @if(!empty($movies) && count($movies) > 0)
            @foreach($movies as $movie)
                <div class="movie">
                    <img src="{{ asset('storage' . $movie->image) }}" alt="{{ $movie->movie_name_vn }}" style="width: 100%; height: auto; border-top-left-radius: 5px; border-top-right-radius: 5px;">
                    
                    <div class="movie-info" style="padding: 10px; text-align: center;">
                        <strong style="font-size: 15px; display: block; margin-bottom: 5px; color: #333;">{{ $movie->movie_name_vn }}</strong>
                        <span style="font-size: 14px; color: #666;">{{ $movie->release_date }}</span>
                    </div>
                </div>
            @endforeach
        @else
            <p style="padding: 20px; font-size: 18px;">Không tìm thấy bộ phim nào phù hợp với từ khóa "{{ $keyword }}".</p>
        @endif
    </div>

@endcomponent