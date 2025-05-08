@extends('layouts.app')

@section('title', 'Movies')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">الأفلام الشائعة</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($movies as $movie)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="w-full h-96 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">{{ $movie->title }}</h2>
                    <p class="text-gray-600 text-sm mb-2">{{ $movie->release_date->format('Y') }}</p>
                    <div class="flex items-center mb-2">
                        <span class="text-yellow-500">★</span>
                        <span class="ml-1">{{ number_format($movie->vote_average, 1) }}</span>
                    </div>
                    <a href="{{ route('movies.show', $movie->id) }}" class="block text-center bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                        عرض التفاصيل
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $movies->links() }}
    </div>
</div>
@endsection 