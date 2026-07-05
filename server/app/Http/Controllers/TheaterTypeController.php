<?php

namespace App\Http\Controllers;

use App\Models\TheaterType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TheaterTypeController extends Controller
{
    public function getTheaterType(): JsonResponse
    {
        try {
            $theaterType = TheaterType::all();

            return response()->json([
                'status' => 'success',
                'message' => 'Geted theater type successfully.',
                'data' => $theaterType
            ], 200);
        } catch (\Exception $error) {
            Log::error("Get TheaterType Error : ". $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Could not fetch theater type. Please try again later.'
            ], 500);
        }
    }


    public function createTheaterType(Request $request): JsonResponse
    {
        $request->validate([
            'theater_type_name' => 'required|string|max:255'
        ]);

        try {
            $theaterType = TheaterType::create([
                'theater_type_name' => $request->theater_type_name
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Created theater type successfully.',
                'data' => $theaterType
            ], 201);
        } catch (\Exception $error) {
            Log::error("Create TheaterType Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Create theater type failed. Please try again later.'
            ], 500);
        }
    }


    public function updateTheaterType(Request $request, $id): JsonResponse
    {
        $validate = $request->validate([
            'theater_type_name' => 'required|string|max:255'
        ]);

        try {
            $theaterType = TheaterType::findOrFail($id);

            $theaterType->update($validate);

            return response()->json([
                'status' => 'success',
                'message' => 'Updated theater type successfully.',
                'data' => $theaterType
            ], 200);
        } catch (\Exception $error) {
            Log::error("Update TheaterType Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Update theater type failed. Please try again later.'
            ], 500);
        }
    }


    public function deleteTheaterType($id): JsonResponse
    {
        try {
            $theaterType = TheaterType::findOrFail($id);

            $theaterType->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'TheaterType deleted (soft delete) successfully.'
            ], 200);
        } catch (\Exception $error) {
            Log::error("Delete TheaterType Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Delete theater type failed. Please try again later.'
            ], 500);
        }
    }


    public function getRestoreTheaterType(): JsonResponse
    {
        try {
            $theaterType = TheaterType::onlyTrashed()->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Geted theater type in trashed successfully.',
                'data' => $theaterType
            ], 200);
        } catch (\Exception $error) {
            Log::error("Get Restore TheaterType Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Could not fetch restore theater type failed. Please try again later.'
            ], 500);
        }
    }


    public function restoreTheaterType($id): JsonResponse
    {
        try {
            $theaterType = TheaterType::withTrashed()->findOrFail($id);

            $theaterType->restore();

            return response()->json([
                'status' => 'success',
                'message' => "TheaterType 'id: $theaterType->id' restored successfully."
            ], 200);
        } catch (\Exception $error) {
            Log::error("Restore TheaterType Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Restore theater type failed. Please try again later.'
            ], 500);
        }
    }
}
