<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Services\TMDBService;


class MovieController extends Controller
{
    protected $tmdbService;
    
    public function __construct(TMDBService $tmdbService)
    {
        $this->middleware('auth');
         $this->middleware(\App\Http\Middleware\CheckRole::class . ':admin,manager');
        $this->tmdbService = $tmdbService;
    }
    
    public function index()
    {
        $movies = Movie::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        return view('admin.movies.index', compact('movies'));
        
    }
    
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.movies.create', compact('categories'));
    }
    
   public function store(Request $request)
{
    if ($request->filled('tmdb_id')) {
        // If importing from TMDB, only validate tmdb_id
        $validated = $request->validate([
            'tmdb_id' => 'required|string',
        ]);

        try {
            $movie = $this->tmdbService->syncMovie($request->tmdb_id);
            return redirect()->route('admin.movies.index')->with('success', 'Movie imported successfully from TMDB.');
        } catch (\Exception $e) {
            return back()->withErrors(['tmdb_id' => 'Failed to import movie from TMDB: ' . $e->getMessage()]);
        }
    } else {
        // Manual entry requires title and other fields (tmdb_id is not required)
        $validated = $request->validate([
            'orginal_title' => 'required|string|max:255',
            'overview' => 'nullable|string',
            'release_date' => 'nullable|date',
            'runtime' => 'nullable|integer|min:1',
            'category_id' => 'nullable|exists:categories,id',
            'poster_path' => 'nullable|string',
            'imdb_id' => 'nullable|integer', 
            'vote_average' => 'nullable|numeric',
            'vote_count' => 'nullable|integer',
        ]);

        $movie = Movie::create($validated);

        return redirect()->route('admin.movies.index')->with('success', 'Movie created successfully.');
    }
}

    
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        
        return view('admin.movies.edit', compact('movie', 'categories'));
    }
    
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'overview' => 'nullable|string',
            'release_date' => 'nullable|date',
            'runtime' => 'nullable|integer|min:1',
            'category_id' => 'nullable|exists:categories,id',
            'poster_path' => 'nullable|string',
            'vote_average' => 'nullable|numeric',
            'vote_count' => 'nullable|integer',
            
        ]);
        
        $movie->update($validated);
        
        return redirect()->route('admin.movies.index')->with('success', 'Movie updated successfully.');
    }
    
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        
        // Check if there are any shows for this movie
        if ($movie->shows()->count() > 0) {
            return back()->with('error', 'Cannot delete movie with existing screenings.');
        }
        
        $movie->delete();
        
        return redirect()->route('admin.movies.index')->with('success', 'Movie deleted successfully.');
    }
    
    public function import()
    {
        $popularMovies = $this->tmdbService->getPopularMovies();
        return view('admin.movies.import', compact('popularMovies'));
    }
    
    public function importMovie($tmdbId)
    {
        try {
            $movie = $this->tmdbService->syncMovie($tmdbId);
            return redirect()->route('admin.movies.index')->with('success', 'Movie imported successfully from TMDB.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to import movie from TMDB: ' . $e->getMessage());
        }
    }
}