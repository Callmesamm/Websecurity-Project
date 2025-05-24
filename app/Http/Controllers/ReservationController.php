<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Show;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $user = auth()->user();

    $reservations = Reservation::where('user_id', $user->id)
        ->with(['show.movie', 'show.hall']) // eager load relations used in blade
        ->orderBy('created_at', 'desc')
        ->paginate(9); // paginate or get all

    return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $showId = $request->query('show_id');
        if (!$showId) {
            return redirect()->route('movies.index')->with('error', 'No show selected for reservation.');
        }

        $show = Show::with('movie')->findOrFail($showId);
        
        // Get existing reservations for this show to mark seats as taken
        $takenSeats = Reservation::where('show_id', $showId)
            ->pluck('seat_number')
            ->toArray();
            
        return view('reservations.create', compact('show', 'takenSeats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validated = $request->validate([
        'show_id' => 'required|exists:shows,id',
        'seat_number' => 'required|integer|min:1',
    ]);

    $show = Show::with('hall')->findOrFail($validated['show_id']);
    
    // Check if the seat is already reserved
    $alreadyReserved = Reservation::where('show_id', $show->id)
        ->where('seat_number', $validated['seat_number'])
        ->exists();
        
    if ($alreadyReserved) {
        return back()->with('error', 'This seat is already reserved.');
    }
    
    // Check if the seat number is valid for this hall
    if ($validated['seat_number'] > $show->hall->capacity) {
        return back()->with('error', 'Invalid seat number for this hall.');
    }
    
    // Create the reservation
    $reservation = Reservation::create([
        'user_id' => Auth::id(),
        'show_id' => $show->id,
        'seat_number' => $validated['seat_number'],
        'price' => $show->price,
    ]);
    
    // Update available seats
    $show->decrement('available_seats');
    
    return back()->with('success', 'Reservation successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
