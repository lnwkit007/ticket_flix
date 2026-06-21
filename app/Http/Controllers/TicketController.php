<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function getMyBookingHistory(Request $request): JsonResponse
    {
        $user = $request->user();

        $tickets = Ticket::where('user_id', $user->id)->with([
            'user',
            'showtime.movie.tags',
            'showtime.theater.theater_type'
        ])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Geted booking history successfully.',
            'data' => $tickets
        ], 200);
    }


    public function bookingTicket(Request $request): JsonResponse
    {
        $request->validate([
            'showtime_id' => 'required|exists:showtimes,id',
            'quantity_seats' => 'required|integer|min:1'
        ]);

        try {
            $result = DB::transaction(function () use ($request) {

                $showtime = Showtime::where('id', $request->showtime_id)->lockForUpdate()->firstOrFail();

                $maxSeats = $showtime->theater->seats_maximum;

                $bookedSeats = Ticket::where('showtime_id', $showtime->id)->sum('quantity_seats');

                if ($bookedSeats + $request->quantity_seats > $maxSeats) {
                    $availableSeats = $maxSeats - $bookedSeats;

                    return [
                        'success' => false,
                        'available_seats' => $availableSeats
                    ];
                }

                $totalPrice = $request->quantity_seats * $showtime->base_price;

                $ticket = Ticket::create([
                    'user_id' => auth()->id(),
                    'showtime_id' => $showtime->id,
                    'quantity_seats' => $request->quantity_seats,
                    'ticket_price' => $totalPrice
                ]);

                return [
                    'success' => true,
                    'ticket' => $ticket
                ];
            });

            if (!$result['success']) {
                return response()->json([
                    'status' => 'error',
                    'message' => "We apologize, but the outdoor movie area is full for this screening. Only {$result['available_seats']} seats are available.",
                    'data' => $result['available_seats']
                ], 400);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Booking successfully.',
                'data' => $result['ticket']
            ], 201);
            
        } catch (\Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage()
            ], 400);
        }
    }
}
