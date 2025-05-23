<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Show;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Movie::query();
        
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }
        
        $movies = $query->paginate(20);
        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'storyline' => 'nullable|string',
            'image' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'rating' => 'nullable|numeric|min:0|max:5',
            'release_date' => 'nullable|date',
            'duration' => 'nullable|integer|min:1',
        ]);
        
        Movie::create($request->all());
        return redirect()->route('movies.index')->with('success', 'Movie added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.show', compact('movie'));
    }

    /**
     * Get showtimes for a movie.
     */
    public function getShowtimes($id)
    {
        $movie = Movie::findOrFail($id);
        $shows = Show::where('movie_id', $id)
            ->where('date', '>=', now()->format('Y-m-d'))
            ->orderBy('date')
            ->orderBy('start_time')
            ->with('movie')
            ->get();
        
        return response()->json($shows);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'storyline' => 'nullable|string',
            'image' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'rating' => 'nullable|numeric|min:0|max:5',
            'release_date' => 'nullable|date',
            'duration' => 'nullable|integer|min:1',
        ]);
        
        $movie = Movie::findOrFail($id);
        $movie->update($request->all());
        
        return redirect()->route('movies.index')->with('success', 'Movie updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully!');
    }
}
