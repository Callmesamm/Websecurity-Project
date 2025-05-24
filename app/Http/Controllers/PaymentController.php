<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Show;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
      $request->validate([
    'show_id' => 'required|exists:shows,id',
    'seat_number' => 'required|integer',
    'card_number' => 'required', // remove regex to test
    'expiry' => 'required',
    'cvv' => 'required|digits:3',
]);


        $show = Show::findOrFail($request->show_id);

        // Check if seat is already taken
        $seatNumber = (int) $request->seat_number;
        $takenSeats = Reservation::where('show_id', $show->id)
                                ->pluck('seat_number')
                                ->toArray();

        if (in_array($seatNumber, $takenSeats)) {
            return back()->withErrors(['seat_number' => 'This seat has already been booked. Please select another seat.']);
        }

        // You can add payment processing here (mock or real)

        // Create reservation
        $reservation = new Reservation();
        $reservation->show_id = $show->id;
        $reservation->seat_number = $seatNumber;
        $reservation->price = $show->price;
        // Add any other fields like user_id if your app requires login
        $reservation->user_id = auth()->id(); // assuming user is logged in
        $reservation->save();

        // Redirect with success message
        return redirect()->route('reservations.index')->with('success', 'Booking successful!');
    }
}
