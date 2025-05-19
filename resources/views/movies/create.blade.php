@extends('layouts.app')

@section('title', 'Add Movie')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Add New Movie</h2>
    <form method="POST" action="{{ route('movies.store') }}">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="storyline" class="form-label">Storyline</label>
            <textarea name="storyline" id="storyline" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="url" name="image" id="image" class="form-control">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" name="category" id="category" class="form-control">
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating (0-5)</label>
            <input type="number" step="0.1" min="0" max="5" name="rating" id="rating" class="form-control">
        </div>
        <div class="mb-3">
            <label for="release_date" class="form-label">Release Date</label>
            <input type="date" name="release_date" id="release_date" class="form-control">
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Duration (minutes)</label>
            <input type="number" min="1" name="duration" id="duration" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Add Movie</button>
    </form>
</div>
@endsection 