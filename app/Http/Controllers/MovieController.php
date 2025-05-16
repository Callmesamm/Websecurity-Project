<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Show;
use App\Services\TMDBService;

class MovieController extends Controller
{
    protected $tmdbService;

    public function __construct(TMDBService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // جلب الأفلام من قاعدة البيانات
        $movies = Movie::with(['actors', 'images'])->paginate(20);

        // إذا لم يكن هناك أفلام، قم بجلبها من TMDB
        if ($movies->isEmpty()) {
            $this->syncMovies();
            $movies = Movie::with(['actors', 'images'])->paginate(20);
        }

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
            'image' => 'nullable|url',
            'category' => 'nullable|string|max:255',
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
        $movie = Movie::with(['actors', 'images'])->findOrFail($id);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    protected function syncMovies()
    {
        // جلب صفحتين من الأفلام الشائعة
        for ($page = 1; $page <= 2; $page++) {
            $movies = $this->tmdbService->getPopularMovies($page);
            
            // تحقق من وجود results
            if (!isset($movies['results'])) {
                dd($movies); // سيعرض محتوى الاستجابة ويساعدك في معرفة الخطأ
            }

            foreach ($movies['results'] as $movieData) {
                $this->tmdbService->syncMovie($movieData['id']);
            }
        }
    }
}
