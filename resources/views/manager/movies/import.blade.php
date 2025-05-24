@extends('layouts.manager')

@section('title', 'Import Movies from TMDB')

@section('header', 'Import Movies from TMDB')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-neutral-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-neutral-100 bg-gradient-to-r from-primary-500 to-secondary-500 text-white">
        <h3 class="font-semibold">Popular Movies from TMDB</h3>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($popularMovies['results'] as $movie)
            <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-neutral-100 transition-all hover:shadow-md">
                <div class="aspect-[2/3] bg-neutral-100 relative">
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="w-full h-full object-cover">
                    <div class="absolute top-2 right-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-star mr-1"></i> {{ number_format($movie['vote_average'], 1) }}
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <h4 class="font-semibold text-lg mb-1 truncate">{{ $movie['title'] }}</h4>
                    <div class="flex items-center text-sm text-neutral-500 mb-2">
                        <i class="fas fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($movie['release_date'])->format('Y') }}
                    </div>
                    <p class="text-sm text-neutral-600 mb-4 line-clamp-3">{{ $movie['overview'] }}</p>
                    <form method="POST" action="{{ route('admin.movies.import.store', $movie['id']) }}">
                        @csrf
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">
                            <i class="fas fa-cloud-download-alt mr-1"></i> Import
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection