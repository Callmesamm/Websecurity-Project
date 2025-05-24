@extends('layouts.app')

@section('title', 'Book Seats - ' . $show->movie->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Select Seats</h3>
                </div>
                <div class="card-body">
                    <!-- Movie info -->
                    <div class="movie-info mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3">
                                <img src="{{ $show->movie->poster_url }}" alt="{{ $show->movie->title }}" class="img-fluid rounded" style="width: 100px;">
                            </div>
                            <div>
                                <h4 class="mb-1">{{ $show->movie->title }}</h4>
                                <p class="mb-1">
                                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($show->date)->format('l, F j, Y') }}
                                </p>
                                <p class="mb-1">
                                    <strong>Time:</strong> {{ \Carbon\Carbon::parse($show->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($show->end_time)->format('g:i A') }}
                                </p>
                                <p class="mb-0">
                                    <strong>Price:</strong> ${{ number_format($show->price, 2) }} per seat
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Seating plan -->
                    <div class="mb-4">
                        <h5 class="text-center mb-3">Seating Plan</h5>
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <div class="mx-2 d-flex align-items-center">
                                <div class="seat-legend available"></div>
                                <span class="ms-1">Available</span>
                            </div>
                            <div class="mx-2 d-flex align-items-center">
                                <div class="seat-legend selected"></div>
                                <span class="ms-1">Selected</span>
                            </div>
                            <div class="mx-2 d-flex align-items-center">
                                <div class="seat-legend taken"></div>
                                <span class="ms-1">Taken</span>
                            </div>
                        </div>
                        
                        <div class="text-center mb-3">
                            <div class="screen-container">
                                <div class="screen mb-4">Screen</div>
                            </div>
                            
                            <div class="seats-container">
                                @php
                                    $totalRows = ceil($show->total_seats / 10);
                                    $seatsPerRow = 10;
                                    $currentSeat = 1;
                                @endphp
                                
                                @for ($row = 1; $row <= $totalRows; $row++)
                                    <div class="seat-row mb-2">
                                        <div class="row-label">{{ chr(64 + $row) }}</div>
                                        @for ($seatInRow = 1; $seatInRow <= $seatsPerRow && $currentSeat <= $show->total_seats; $seatInRow++)
                                            @php
                                                $isTaken = in_array($currentSeat, $takenSeats);
                                                $seatClass = $isTaken ? 'taken' : 'available';
                                            @endphp
                                            <div class="seat {{ $seatClass }}" data-seat-number="{{ $currentSeat }}" @if($isTaken) disabled @endif></div>
                                            @php $currentSeat++; @endphp
                                        @endfor
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <!-- Reservation form -->
                    <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
                        @csrf
                        <input type="hidden" name="show_id" value="{{ $show->id }}">
                        <input type="hidden" name="seat_number" id="selected_seat" value="">
                        
                        <div class="mb-3">
                            <div class="alert alert-primary d-flex align-items-center" role="alert">
                                <div>
                                    <strong>Selected Seat:</strong> <span id="selected_seat_display">None</span>
                                </div>
                            </div>
                        </div>

                        <!-- Visa card payment fields -->
                        <div class="mb-3">
                            <label for="card_number" class="form-label">Card Number (Visa only)</label>
                            <input type="text" name="card_number" id="card_number" class="form-control" placeholder="4111 1111 1111 1111" required pattern="4[0-9]{12}(?:[0-9]{3})?" title="Visa card number">
                        </div>

                        <div class="mb-3">
                            <label for="expiry" class="form-label">Expiry Date (MM/YY)</label>
                            <input type="text" name="expiry" id="expiry" class="form-control" placeholder="MM/YY" required pattern="(0[1-9]|1[0-2])\/?([0-9]{2})" title="MM/YY format">
                        </div>

                        <div class="mb-3">
                            <label for="cvv" class="form-label">CVV</label>
                            <input type="text" name="cvv" id="cvv" class="form-control" placeholder="123" required pattern="[0-9]{3}" title="3 digit CVV">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('movies.show', $show->movie->id) }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary" id="bookButton" disabled>Pay ${{ number_format($show->price, 2) }} and Book</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .seat-legend {
        width: 24px;
        height: 24px;
        border-radius: 5px;
        margin-right: 5px;
    }
    .seat-legend.available {
        background-color: #ccc;
    }
    .seat-legend.selected {
        background-color: #6c63ff;
    }
    .seat-legend.taken {
        background-color: #e63946;
    }
    
    .screen-container {
        perspective: 500px;
        margin-bottom: 30px;
    }
    
    .screen {
        height: 40px;
        background-color: #fff;
        width: 100%;
        transform: rotateX(-30deg);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.7);
        color: #777;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .seats-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-width: 480px;
        margin: 0 auto;
    }
    
    .seat-row {
        display: flex;
        justify-content: center;
        gap: 8px;
    }
    
    .row-label {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 10px;
    }
    
    .seat {
        width: 24px;
        height: 24px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .seat.available {
        background-color: #ccc;
    }
    
    .seat.available:hover {
        transform: scale(1.1);
        background-color: #ddd;
    }
    
    .seat.selected {
        background-color: #6c63ff;
    }
    
    .seat.taken {
        background-color: #e63946;
        cursor: not-allowed;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const seats = document.querySelectorAll('.seat.available');
        const selectedSeatInput = document.getElementById('selected_seat');
        const selectedSeatDisplay = document.getElementById('selected_seat_display');
        const bookButton = document.getElementById('bookButton');
        let selectedSeat = null;

        seats.forEach(seat => {
            seat.addEventListener('click', function() {
                // Reset previously selected seat
                if (selectedSeat) {
                    selectedSeat.classList.remove('selected');
                }

                // Set new selected seat
                seat.classList.add('selected');
                selectedSeat = seat;

                // Update form input with seat number
                const seatNumber = seat.getAttribute('data-seat-number');
                selectedSeatInput.value = seatNumber;

                // Update display
                const rowChar = String.fromCharCode(65 + Math.floor((seatNumber - 1) / 10));
                const seatInRow = ((seatNumber - 1) % 10) + 1;
                selectedSeatDisplay.textContent = `${rowChar}${seatInRow} (Seat #${seatNumber})`;

                // Enable book button only if a seat selected
                bookButton.disabled = false;
            });
        });
    });
</script>
@endsection
