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
        //
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
        $request->validate([
            'show_id' => 'required|exists:shows,id',
            'seat_number' => 'required|integer|min:1',
        ]);

        $show = Show::findOrFail($request->show_id);
        // تحقق أن المقعد غير محجوز مسبقاً
        $alreadyReserved = Reservation::where('show_id', $show->id)
            ->where('seat_number', $request->seat_number)
            ->exists();
        if ($alreadyReserved) {
            return back()->withErrors(['seat_number' => 'This seat is already reserved.']);
        }
        // تحقق من توفر المقاعد
        if ($show->available_seats <= 0) {
            return back()->withErrors(['seat_number' => 'No available seats for this show.']);
        }
        // إنشاء الحجز
        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'show_id' => $show->id,
            'seat_number' => $request->seat_number,
            'price' => $show->price,
        ]);
        // تحديث عدد المقاعد المتاحة
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
