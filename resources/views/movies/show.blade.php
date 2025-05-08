@extends('layouts.app')

@section('title', $movie->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="relative h-96">
            <img src="{{ $movie->backdrop_url }}" alt="{{ $movie->title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-8 text-white">
                <h1 class="text-4xl font-bold mb-2">{{ $movie->title }}</h1>
                <p class="text-xl mb-4">{{ $movie->tagline }}</p>
                <div class="flex items-center space-x-4">
                    <span class="text-yellow-500 text-xl">★ {{ number_format($movie->vote_average, 1) }}</span>
                    <span>{{ $movie->release_date->format('Y') }}</span>
                    <span>{{ $movie->runtime }} دقيقة</span>
                </div>
            </div>
        </div>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-2">
                    <h2 class="text-2xl font-bold mb-4">القصة</h2>
                    <p class="text-gray-700 mb-8">{{ $movie->overview }}</p>

                    <h2 class="text-2xl font-bold mb-4">الممثلون</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach($movie->actors as $actor)
                            <div class="text-center">
                                <img src="{{ $actor->profile_url }}" alt="{{ $actor->name }}" class="w-24 h-24 rounded-full mx-auto mb-2 object-cover">
                                <h3 class="font-semibold">{{ $actor->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $actor->pivot->character_name }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <h3 class="font-bold mb-2">معلومات الفيلم</h3>
                        <ul class="space-y-2">
                            <li><span class="font-semibold">الحالة:</span> {{ $movie->status }}</li>
                            <li><span class="font-semibold">الميزانية:</span> ${{ number_format($movie->budget) }}</li>
                            <li><span class="font-semibold">الإيرادات:</span> ${{ number_format($movie->revenue) }}</li>
                            <li><span class="font-semibold">IMDB:</span> {{ $movie->imdb_id }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 