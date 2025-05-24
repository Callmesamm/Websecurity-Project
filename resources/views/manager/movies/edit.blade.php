@extends('layouts.manager')

@section('title', 'Edit Movie')

@section('header', 'Edit Movie')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="md:col-span-1">
            <div class="aspect-[2/3] bg-neutral-100 rounded-lg overflow-hidden">
                <img src="{{ $movie->poster_url ?? '/placeholder.svg?height=300&width=200' }}" alt="{{ $movie->title }}" class="w-full h-full object-cover">
            </div>
        </div>
        
        <div class="md:col-span-3">
            <form method="POST" action="{{ route('admin.movies.update', $movie->id) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $movie->title) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="overview" class="block text-gray-700 font-medium mb-2">Overview</label>
                    <textarea name="overview" id="overview" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('overview', $movie->overview) }}</textarea>
                    @error('overview')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="poster_path" class="block text-gray-700 font-medium mb-2">Poster URL</label>
                    <input type="text" name="poster_path" id="poster_path" value="{{ old('poster_path', $movie->poster_path) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('poster_path')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="release_date" class="block text-gray-700 font-medium mb-2">Release Date</label>
                        <input type="date" name="release_date" id="release_date" value="{{ old('release_date', $movie->release_date ? $movie->release_date->format('Y-m-d') : '') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('release_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="duration" class="block text-gray-700 font-medium mb-2">Duration (minutes)</label>
                        <input type="number" name="duration" id="duration" value="{{ old('duration', $movie->duration) }}" min="1" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('duration')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="category_id" class="block text-gray-700 font-medium mb-2">Category</label>
                        <select name="category_id" id="category_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $movie->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <a href="{{ route('admin.movies.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded mr-2">
                        Cancel
                    </a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">
                        Update Movie
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection