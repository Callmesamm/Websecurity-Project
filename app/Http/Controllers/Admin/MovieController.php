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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'overview' => 'nullable|string',
            'release_date' => 'nullable|date',
            'duration' => 'nullable|integer|min:1',
            'category_id' => 'nullable|exists:categories,id',
            'poster_path' => 'nullable|string',
            'tmdb_id' => 'nullable|string',
        ]);
        
        // If TMDB ID is provided, fetch data from TMDB
        if ($request->filled('tmdb_id')) {
            try {
                $movie = $this->tmdbService->syncMovie($request->tmdb_id);
                return redirect()->route('admin.movies.index')->with('success', 'Movie imported successfully from TMDB.');
            } catch (\Exception $e) {
                return back()->withErrors(['tmdb_id' => 'Failed to import movie from TMDB: ' . $e->getMessage()]);
            }
        }
        
        // Otherwise create movie with provided data
        $movie = Movie::create([
            'title' => $request->title,
            'overview' => $request->overview,
            'release_date' => $request->release_date,
            'duration' => $request->duration,
            'category_id' => $request->category_id,
            'poster_path' => $request->poster_path,
        ]);
        
        return redirect()->route('admin.movies.index')->with('success', 'Movie created successfully.');
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
            'duration' => 'nullable|integer|min:1',
            'category_id' => 'nullable|exists:categories,id',
            'poster_path' => 'nullable|string',
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