@extends('layouts.admin')

@section('title', 'Create Screening')

@section('header', 'Create New Screening')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <form method="POST" action="{{ route('admin.shows.store') }}">
        @csrf
        
        <div class="mb-4">
            <label for="movie_id" class="block text-gray-700 font-medium mb-2">Movie</label>
            <select name="movie_id" id="movie_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                <option value="">Select a movie</option>
                @foreach($movies as $movie)
                    <option value="{{ $movie->id }}">{{ $movie->title }} ({{ $movie->duration ?? 'N/A' }} min)</option>
                @endforeach
            </select>
            @error('movie_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="hall_id" class="block text-gray-700 font-medium mb-2">Hall</label>
            <select name="hall_id" id="hall_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                <option value="">Select a hall</option>
                @foreach($halls as $hall)
                    <option value="{{ $hall->id }}">{{ $hall->name }} (Capacity: {{ $hall->capacity }})</option>
                @endforeach
            </select>
            @error('hall_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="date" class="block text-gray-700 font-medium mb-2">Date</label>
            <input type="date" name="date" id="date" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required min="{{ date('Y-m-d') }}">
            @error('date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="start_time" class="block text-gray-700 font-medium mb-2">Start Time</label>
            <input type="time" name="start_time" id="start_time" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            @error('start_time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-medium mb-2">Ticket Price ($)</label>
            <input type="number" name="price" id="price" step="0.01" min="0" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex justify-end">
            <a href="{{ route('admin.shows.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded mr-2">
                Cancel
            </a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">
                Create Screening
            </button>
        </div>
    </form>
</div>
@endsection