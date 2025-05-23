@extends('layouts.admin')

@section('title', 'Movies Management')

@section('header', 'Movies Management')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-neutral-100 overflow-hidden">
    <div class="flex justify-between items-center px-6 py-4 border-b border-neutral-100 bg-gradient-to-r from-primary-500 to-secondary-500 text-white">
        <h3 class="font-semibold">All Movies</h3>
        <div class="flex space-x-2">
            <a href="{{ route('admin.movies.import') }}" class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-md shadow-sm transition-colors backdrop-blur-sm">
                <i class="fas fa-cloud-download-alt mr-2"></i> Import from TMDB
            </a>
            <a href="{{ route('admin.movies.create') }}" class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-md shadow-sm transition-colors backdrop-blur-sm">
                <i class="fas fa-plus mr-2"></i> Add New Movie
            </a>
        </div>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($movies as $movie)
            <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-neutral-100 transition-all hover:shadow-md">
                <div class="aspect-[2/3] bg-neutral-100 relative">
                    <img src="{{ $movie->poster_url ?? '/placeholder.svg?height=300&width=200' }}" alt="{{ $movie->title }}" class="w-full h-full object-cover">
                    <div class="absolute top-2 right-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-star mr-1"></i> {{ number_format($movie->rating, 1) }}
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <h4 class="font-semibold text-lg mb-1 truncate">{{ $movie->title }}</h4>
                    <div class="flex items-center text-sm text-neutral-500 mb-2">
                        <i class="fas fa-calendar-alt mr-1"></i> {{ $movie->release_date ? $movie->release_date->format('Y') : 'N/A' }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-clock mr-1"></i> {{ $movie->duration ?? 'N/A' }} min
                    </div>
                    <div class="mb-3">
                        @if($movie->category)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                {{ $movie->category->name }}
                            </span>
                        @endif
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('admin.movies.edit', $movie->id) }}" class="text-secondary-600 hover:text-secondary-900">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <form method="POST" action="{{ route('admin.movies.destroy', $movie->id) }}" onsubmit="return confirm('Are you sure you want to delete this movie?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-accent-600 hover:text-accent-900">
                                <i class="fas fa-trash mr-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
<!--         
        <div class="mt-6">
            {{ $movies->links() }}
        </div> -->
    </div>
</div>
@endsection