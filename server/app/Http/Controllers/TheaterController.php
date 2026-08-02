<?php

namespace App\Http\Controllers;

use App\Models\Theater;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class TheaterController extends Controller
{
    public function getTheater(): JsonResponse
    {
        try {
            $theater = Theater::all();

            return response()->json([
                'status' => 'success',
                'message' => 'Geted theater successfully.',
                'data' => $theater
            ], 200);
        } catch (\Exception $error) {
            Log::error("Get Theater Error", [
                'exception' => $error
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Could not fetch theater. Please try again later.'
            ], 500);
        }
    }


    public function createTheater(Request $request): JsonResponse
    {
        $request->validate([
            'theater_name' => 'required|string|max:255',
            'seats_maximum' => 'required|integer|min:1',
            'theater_type_id' => ['required', Rule::exists('theater_type', 'id')]
        ]);

        try {
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
        } catch (\Exception $error) {
            Log::error("Create Theater", [
                'exception' => $error
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Create theater failed. Please try again later.'
            ], 500);
        }
    }


    public function updateTheater(Request $request, $id): JsonResponse
    {
        $validate = $request->validate([
            'theater_name' => 'sometimes|string|max:255',
            'seats_maximum' => 'sometimes|integer|min:1',
            'theater_type_id' => ['sometimes', Rule::exists('theater_type', 'id')]
        ]);

        try {
            $theater = Theater::findOrFail($id);

            $theater->update($validate);

            return response()->json([
                'status' => 'success',
                'message' => 'Updated theater successfully.',
                'data' => $theater
            ], 200);
        } catch (\Exception $error) {
            Log::error("Update Theater Error", [
                'exception' => $error
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Update theater failed. Please try again later.'
            ], 500);
        }
    }


    public function deleteTheater($id): JsonResponse
    {
        try {
            $theater = Theater::findOrFail($id);

            $theater->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Theater deleted (soft delete) successfully.'
            ], 200);
        } catch (\Exception $error) {
            Log::error("Delete Theater Error", [
                'exception' => $error
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Delete Theater failed. Please try again later.'
            ], 500);
        }
    }


    public function getRestoreTheater(): JsonResponse
    {
        try {
            $theater = Theater::onlyTrashed()->with('theater_type')->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Geted theater in trashed successfully.',
                'data' => $theater
            ], 200);
        } catch (\Exception $error) {
            Log::error("Get Restore Theater Error", [
                'exception' => $error
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Could not fetch restore theater. Please try again later.'
            ], 500);
        }
    }


    public function restoreTheater($id): JsonResponse
    {
        try {
            $theater = Theater::withTrashed()->findOrFail($id);

            $theater->restore();

            return response()->json([
                'status' => 'success',
                'message' => "Theater 'id: $theater->id' restored successfully."
            ], 200);
        } catch (\Exception $error) {
            Log::error("Restore Theater Error", [
                'exception' => $error
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Restore theater failed. Please try again later.'
            ], 500);
        }
    }
}
