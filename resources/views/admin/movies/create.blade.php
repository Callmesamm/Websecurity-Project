@extends('layouts.admin')

@section('title', 'Add Movie')

@section('header', 'Add New Movie')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="mb-6">
        <div class="bg-primary-50 border-l-4 border-primary-500 text-primary-700 p-4 rounded" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm">You can add a movie manually or import it from TMDB by providing the TMDB ID.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Import from TMDB</h3>
        <form method="POST" action="{{ route('admin.movies.store') }}" class="mb-6">
            @csrf
            <div class="mb-4">
                <label for="tmdb_id" class="block text-gray-700 font-medium mb-2">TMDB ID</label>
                <input type="text" name="tmdb_id" id="tmdb_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="e.g. 550 for Fight Club">
                @error('tmdb_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">
                Import from TMDB
            </button>
        </form>
    </div>

    <div class="border-t border-gray-200 pt-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Add Movie Manually</h3>
        <form method="POST" action="{{ route('admin.movies.store') }}">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="overview" class="block text-gray-700 font-medium mb-2">Overview</label>
                <textarea name="overview" id="overview" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('overview') }}</textarea>
                @error('overview')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="poster_path" class="block text-gray-700 font-medium mb-2">Poster URL</label>
                <input type="text" name="poster_path" id="poster_path" value="{{ old('poster_path') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('poster_path')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label for="release_date" class="block text-gray-700 font-medium mb-2">Release Date</label>
                    <input type="date" name="release_date" id="release_date" value="{{ old('release_date') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('release_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="duration" class="block text-gray-700 font-medium mb-2">Duration (minutes)</label>
                    <input type="number" name="duration" id="duration" value="{{ old('duration') }}" min="1" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('duration')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="category_id" class="block text-gray-700 font-medium mb-2">Category</label>
                    <select name="category_id" id="category_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                    Create Movie
                </button>
            </div>
        </form>
    </div>
</div>
@endsection