<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Show;
use App\Models\Movie;
use App\Models\Hall;
use Carbon\Carbon;

class ShowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(\App\Http\Middleware\CheckRole::class . ':manager');
    }

    public function index()
    {
        $shows = Show::with(['movie', 'hall'])->orderBy('date')->orderBy('start_time')->paginate(15);
        return view('manager.shows.index', compact('shows'));
    }

    public function create()
    {
        $movies = Movie::orderBy('title')->get();
        $halls = Hall::where('is_active', true)->get();
        return view('manager.shows.create', compact('movies', 'halls'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'hall_id' => 'required|exists:halls,id',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'price' => 'required|numeric|min:0',
        ]);

        $movie = Movie::findOrFail($request->movie_id);
        $hall = Hall::findOrFail($request->hall_id);
        $startTime = Carbon::parse($request->start_time);
        $endTime = $startTime->copy()->addMinutes($movie->duration ?? 120);

        $overlapping = Show::where('hall_id', $hall->id)
            ->where('date', $request->date)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime]);
            })->exists();

        if ($overlapping) {
            return back()->withErrors(['start_time' => 'Show time overlaps with another show in this hall.']);
        }

        Show::create([
            'movie_id' => $request->movie_id,
            'hall_id' => $request->hall_id,
            'date' => $request->date,
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $endTime->format('H:i:s'),
            'price' => $request->price,
            'total_seats' => $hall->capacity,
            'available_seats' => $hall->capacity,
        ]);

        return redirect()->route('manager.shows.index')->with('success', 'Show created successfully.');
    }

    public function edit($id)
    {
        $show = Show::findOrFail($id);
        $movies = Movie::orderBy('title')->get();
        $halls = Hall::where('is_active', true)->get();

        return view('manager.shows.edit', compact('show', 'movies', 'halls'));
    }

    public function update(Request $request, $id)
    {
        $show = Show::findOrFail($id);

        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'hall_id' => 'required|exists:halls,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'price' => 'required|numeric|min:0',
        ]);

        $movie = Movie::findOrFail($request->movie_id);
        $hall = Hall::findOrFail($request->hall_id);
        $startTime = Carbon::parse($request->start_time);
        $endTime = $startTime->copy()->addMinutes($movie->duration ?? 120);

        $overlapping = Show::where('hall_id', $hall->id)
            ->where('date', $request->date)
            ->where('id', '!=', $id)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime]);
            })->exists();

        if ($overlapping) {
            return back()->withErrors(['start_time' => 'Overlapping show exists in this hall.']);
        }

        $reservedSeats = $show->total_seats - $show->available_seats;
        $newTotal = $hall->capacity;
        $newAvailable = $newTotal - $reservedSeats;

        $show->update([
            'movie_id' => $request->movie_id,
            'hall_id' => $request->hall_id,
            'date' => $request->date,
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $endTime->format('H:i:s'),
            'price' => $request->price,
            'total_seats' => $newTotal,
            'available_seats' => $newAvailable,
        ]);

        return redirect()->route('manager.shows.index')->with('success', 'Show updated successfully.');
    }

    public function destroy($id)
    {
        $show = Show::findOrFail($id);

        if ($show->reservations()->count() > 0) {
            return back()->with('error', 'Cannot delete show with existing reservations.');
        }

        $show->delete();
        return redirect()->route('manager.shows.index')->with('success', 'Show deleted successfully.');
    }
}
