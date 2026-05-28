<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShowtimeController extends Controller
{
    public function createShowtime(Request $request): JsonResponse
    {
        $request->validate([
            'movie_id' => ['required', Rule::exists('movies', 'movie_id')->whereNull('deleted_at')],
            'theater_id' => 'required|exists:theaters,id',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'base_price' => 'required|numeric|min:0',
        ]);

        $showtime = Showtime::create([
            'movie_id' => $request->movie_id,
            'theater_id' => $request->theater_id,
            'start_time' => $request->start_time,
            'base_price' => $request->base_price
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Create showtime successfully.',
            'data' => $showtime
        ], 201);
    }
}
