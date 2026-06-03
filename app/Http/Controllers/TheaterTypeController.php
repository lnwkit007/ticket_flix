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
        ], 200);
    }
}
