<?php

namespace App\Http\Controllers;

use App\Models\MovieTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MovieTagController extends Controller
{
    public function getMovieTags(): JsonResponse
    {
        try {
            $movieTag = MovieTag::all();

            return response()->json([
                'status' => 'success',
                'message' => 'Geted movie tag successfully.',
                'data' => $movieTag
            ], 200);
        } catch (\Exception $error) {
            Log::error("Get MovieTag Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Could not fetch movie tag. Please try again later.'
            ], 500);
        }
    }


    public function createMovieTag(Request $request): JsonResponse
    {
        $request->validate([
            'movie_tag_name' => 'required|string|max:255'
        ]);

        try {
            $movieTag = MovieTag::create([
                'movie_tag_name' => $request->movie_tag_name
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Created movie tag successfully.',
                'data' => $movieTag
            ], 201);
        } catch (\Exception $error) {
            Log::error("Create MovieTag Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Create movie tag failed. Please try again later.'
            ], 500);
        }
    }


    public function updateMovieTag(Request $request, $id): JsonResponse
    {
        $validate = $request->validate([
            'movie_tag_name' => 'required|string|max:255'
        ]);

        try {
            $movieTag = MovieTag::findOrFail($id);

            $movieTag->update($validate);

            return response()->json([
                'status' => 'success',
                'message' => 'Updated movie tag successfully.',
                'data' => $movieTag
            ], 200);
        } catch (\Exception $error) {
            Log::error("Update MovieTag Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Update movie tag failed. Please try again later.'
            ], 500);
        }
    }


    public function deleteMovieTag($id): JsonResponse
    {
        try {
            $movieTag = MovieTag::findOrFail($id);

            $movieTag->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Movie Tag deleted (soft delete) successfully.'
            ], 200);
        } catch (\Exception $error) {
            Log::error("Delete MovieTag Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Delete movie tag failed. Please try again later.'
            ], 500);
        }
    }


    public function getRestoreMovieTag(): JsonResponse
    {
        try {
            $movieTag = MovieTag::onlyTrashed()->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Geted movie tag in trashed successfully.',
                'data' => $movieTag
            ], 200);
        } catch (\Exception $error) {
            Log::error("Get Restore MovieTag Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Could not fetch restore movie tag. Please try again later.'
            ], 500);
        }
    }


    public function restoreMovieTag($id): JsonResponse
    {
        try {
            $movieTag = MovieTag::withTrashed()->findOrFail($id);

            $movieTag->restore();

            return response()->json([
                'status' => 'success',
                'message' => "Movie Tag 'id: $movieTag->id' restored successfully."
            ], 200);
        } catch (\Exception $error) {
            Log::error("Restore Movie Tag", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Restore movie tag failed. Please try again later.'
            ], 500);
        }
    }
}
