<x-movie-layout>
    <x-slot name="title">
        {{ $genre->genre_name_vn }} - MovieDB
    </x-slot>

    <h3 style="margin-bottom: 20px; color: #333;">
        <i class="fa fa-film"></i> {{ $genre->genre_name_vn }}
    </h3>

    <div class="list-movie">
        @forelse($movies as $movie)
            <div class="movie shadow-sm">
                <a href="{{ url('/movie/'.$movie->id) }}">
                    {{-- Hiển thị ảnh từ storage/app/public --}}
                    <img src="{{ asset('storage' . $movie->image) }}" 
                         alt="{{ $movie->movie_name }}" 
                         style="width:100%; height:300px; object-fit:cover;">
                    
                    <div class="p-2 bg-white">
                        <h6 class="text-truncate" style="font-size: 0.9rem; color: #333;" title="{{ $movie->movie_name_vn }}">
                            <b>{{ $movie->movie_name_vn }}</b>
                        </h6>
                        <p class="text-muted mb-0" style="font-size: 0.8rem;">
                            {{ $movie->release_date }}
                        </p>
                    </div>
                </a>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                <p style="color: #999; font-size: 1.1rem;">Không tìm thấy phim nào trong thể loại này.</p>
            </div>
        @endforelse
    </div>
</x-movie-layout>
