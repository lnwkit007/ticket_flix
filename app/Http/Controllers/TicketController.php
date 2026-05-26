<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function bookingTicket(Request $request): JsonResponse
    {
        $request->validate([
            'user_id' => 'required | exists:users,id',
            'showtime_id' => 'required | exists:showtimes,id',
            'quantity_seats' => 'required | integer | min:1'
        ]);

        $showtime = Showtime::with('theater')->find($request->showtime_id);

        $maxSeats = $showtime->theater->seats_maximum;

        $bookedSeats = Ticket::where('showtime_id', $showtime->id)->sum('quantity_seats');

        // Validate Quantity Seats
        if ($bookedSeats + $request->quantity_seats > $maxSeats) {
            $availableSeats = $maxSeats - $bookedSeats;
            return response()->json([
                'status' => 'error',
                'message' => "We apologize, but the outdoor movie area is full for this screening. Only {$availableSeats} seats are available.",
                'data' => $availableSeats
            ], 400);
        }

        $totalPrice = $request->quantity_seats * $showtime->base_price;

        $ticket = Ticket::create([
            'user_id' => $request->user_id,
            'showtime_id' => $request->showtime_id,
            'quantity_seats' => $request->quantity_seats,
            'ticket_price' => $totalPrice
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Ticketed sucsessfully !!',
            'data' => $ticket
        ], 201);
    }

    
    public function getMyBookingHistory($userId): JsonResponse
    {
        User::findOrFail($userId);

        $tickets = Ticket::where('user_id', $userId)->with([
            'showtime.movie',
            'showtime.theater.theater_type'
        ])
        ->orderBy('created_at','desc')
        ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Get booking history successfully',
            'data' => $tickets
        ], 200);
    }
}
