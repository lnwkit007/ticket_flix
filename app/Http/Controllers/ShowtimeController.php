<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ShowtimeController extends Controller
{
    public function getShowtimes(): JsonResponse
    {
        try {
            $showtimes = Showtime::with('movie.tags', 'theater.theater_type')->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Geted showtimes successfully.',
                'data' => $showtimes
            ], 200);
        } catch (\Exception $error) {
            Log::error("Get Showtimes Error : ". $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Could not fetch showtimes failed. Please try again later.'
            ], 500);
        }
    }


    public function createShowtime(Request $request): JsonResponse
    {
        $request->validate([
            'movie_id' => ['required', Rule::exists('movies', 'id')->whereNull('deleted_at')],
            'theater_id' => ['required', Rule::exists('theaters', 'id')->whereNull('deleted_at')],
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'base_price' => 'required|numeric|min:0',
        ]);

        try {
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
        } catch (\Exception $error) {
            Log::error("Create Showtime Error : ". $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Create showtime failed. Please try again later.'
            ], 500);
        }
    }


    public function updateShowtime(Request $request, $id): JsonResponse
    {
        $validate = $request->validate([
            'movie_id' => ['sometimes', Rule::exists('movies', 'id')->whereNull('deleted_at')],
            'theater_id' => ['sometimes', Rule::exists('theaters', 'id')->whereNull('deleted_at')],
            'start_time' => 'sometimes|date_format:Y-m-d H:i:s',
            'base_price' => 'sometimes|numeric|min:0'
        ]);

        try {
            $showtime = Showtime::findOrFail($id);

            $showtime->update($validate);

            return response()->json([
                'status' => 'success',
                'message' => 'Updated showtime successfully.',
                'data' => $showtime
            ], 200);
        } catch (\Exception $error) {
            Log::error("Update Showtime Error : ". $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Update showtime failed. Please try again later.'
            ], 500);
        }
    }


    public function deleteShowtime($id): JsonResponse
    {
        try {
            $showtime = Showtime::findOrFail($id);

            $showtime->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Showtime deleted (soft delete) successfully.'
            ], 200);
        } catch (\Exception $error) {
            Log::error("Delete Showtime Error : ". $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Delete showtime failed. Please try again later.'
            ], 500);
        }
    }


    public function getRestoreShowtime(): JsonResponse
    {
        try {
            $showtime = Showtime::onlyTrashed()->with('movie.tags')->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Geted showtime in trashed successfully.',
                'data' => $showtime
            ], 200);
        } catch (\Exception $error) {
            Log::error("Get Restore Showtime Error : ". $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Could not fetch restore showtime. Please try again later.'
            ], 500);
        }
    }


    public function restoreShowtime($id): JsonResponse
    {
        try {
            $showtime = Showtime::withTrashed()->findOrFail($id);

            $showtime->restore();

            return response()->json([
                'status' => 'success',
                'message' => "Showtime 'id: $showtime->id' restored successfully."
            ], 200);
        } catch (\Exception $error) {
            Log::error("Restore Showtime Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Restore showtime failed. Please try again later.'
            ], 500);
        }
    }
}
