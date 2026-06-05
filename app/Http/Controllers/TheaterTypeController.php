<?php

namespace App\Http\Controllers;

use App\Models\TheaterType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TheaterTypeController extends Controller
{
    public function getTheaterType(): JsonResponse
    {
        $theaterType = TheaterType::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Geted theater type successfully.',
            'data' => $theaterType
        ], 200);
    }


    public function createTheaterType(Request $request): JsonResponse
    {
        $request->validate([
            'theater_type_name' => 'required|string|max:255'
        ]);

        $theaterType = TheaterType::create([
            'theater_type_name' => $request->theater_type_name
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Created theater type successfully.',
            'data' => $theaterType
        ], 201);
    }


    public function updateTheaterType(Request $request, $id): JsonResponse
    {
        $validate = $request->validate([
            'theater_type_name' => 'required|string|max:255'
        ]);

        $theaterType = TheaterType::findOrFail($id);

        $theaterType->update($validate);

        return response()->json([
            'status' => 'success',
            'message' => 'Updated theater type successfully.',
            'data' => $theaterType
        ], 200);
    }


    public function deleteTheaterType($id): JsonResponse
    {
        $theaterType = TheaterType::findOrFail($id);

        $theaterType->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'TheaterType deleted (soft delete) successfully.'
        ], 200);
    }


    public function getRestoreTheaterType(): JsonResponse
    {
        $theaterType = TheaterType::onlyTrashed()->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Geted theater type in trashed successfully.',
            'data' => $theaterType
        ], 200);
    }


    public function restoreTheaterType($id): JsonResponse
    {
        $theaterType = TheaterType::withTrashed()->findOrFail($id);

        $theaterType->restore();

        return response()->json([
            'status' => 'success',
            'message' => "TheaterType 'id: $theaterType->id' restored successfully."
        ], 200);
    }
}
