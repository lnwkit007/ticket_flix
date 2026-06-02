<?php

namespace App\Http\Controllers;

use App\Models\Theater;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TheaterController extends Controller
{
    public function getTheater(): JsonResponse
    {
        $theater = Theater::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Geted theater successfully.',
            'data' => $theater
        ], 200);
    }


    public function createTheater(Request $request): JsonResponse
    {
        $request->validate([
            'theater_name' => 'required|string|max:255',
            'seats_maximum' => 'required|integer|min:1',
            'theater_type_id' => ['required', Rule::exists('theater_type', 'id')]
        ]);

        $theater = Theater::create([
            'theater_name' => $request->theater_name,
            'seats_maximum' => $request->seats_maximum,
            'theater_type_id' => $request->theater_type_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Created theater successfully.',
            'data' => $theater
        ], 201);
    }


    public function updateTheater(Request $request, $id): JsonResponse
    {
        $validate = $request->validate([
            'theater_name' => 'sometimes|string|max:255',
            'seats_maximum' => 'sometimes|integer|min:1',
            'theater_type_id' => ['required', Rule::exists('theater_type', 'id')]
        ]);

        $theater = Theater::findOrFail($id);

        $theater->update($validate);

        return response()->json([
            'status' => 'success',
            'message' => 'Updated theater successfully.',
            'data' => $theater
        ], 200);
    }
}
