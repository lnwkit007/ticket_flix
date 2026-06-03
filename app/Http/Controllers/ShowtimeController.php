<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShowtimeController extends Controller
{
    public function getShowtimes(): JsonResponse
    {
        $showtimes = Showtime::with('movie.tags', 'theater.theater_type')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Geted showtimes successfully.',
            'data' => $showtimes
        ], 200);
    }


    public function createShowtime(Request $request): JsonResponse
    {
        $request->validate([
            'movie_id' => ['required', Rule::exists('movies', 'id')->whereNull('deleted_at')],
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


    public function updateShowtime(Request $request, $id): JsonResponse
    {
        $validate = $request->validate([
            'movie_id' => ['sometimes', Rule::exists('movies', 'id')->whereNull('deleted_at')],
            'theater_id' => 'sometimes|exists:theaters,id',
            'start_time' => 'sometimes|date_format:Y-m-d H:i:s',
            'base_price' => 'sometimes|numeric|min:0'
        ]);

        $showtime = Showtime::findOrFail($id);

        $showtime->update($validate);

        return response()->json([
            'status' => 'success',
            'message' => 'Updated showtime successfully.',
            'data' => $showtime
        ], 200);
    }


    public function deleteShowtime($id): JsonResponse
    {
        $showtime = Showtime::findOrFail($id);

        $showtime->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Showtime deleted (soft delete) successfully.'
        ], 200);
    }


    public function getRestoreShowtime(): JsonResponse
    {
        $showtime = Showtime::onlyTrashed()->with('movie.tags')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Geted showtime in trashed successfully.',
            'data' => $showtime
        ], 200);
    }


    public function restoreShowtime($id): JsonResponse
    {
        $showtime = Showtime::withTrashed()->findOrFail($id);

        $showtime->restore();

        return response()->json([
            'status' => 'success',
            'message' => "Showtime 'id: $showtime->id' restored successfully."
        ], 200);
    }
}
