<?php

namespace App\Http\Controllers;

use App\Models\MovieTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MovieTagController extends Controller
{
    public function getMovieTags(): JsonResponse
    {
        $movieTag = MovieTag::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Geted movie tag successfully.',
            'data' => $movieTag
        ], 200);
    }


    public function createMovieTag(Request $request): JsonResponse
    {
        $request->validate([
            'movie_tag_name' => 'required|string|max:255'
        ]);

        $movieTag = MovieTag::create([
            'movie_tag_name' => $request->movie_tag_name
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Created movie tag successfully.',
            'data' => $movieTag
        ], 201);
    }


    public function updateMovieTag(Request $request, $id): JsonResponse
    {
        $validate = $request->validate([
            'movie_tag_name' => 'required|string|max:255'
        ]);

        $movieTag = MovieTag::findOrFail($id);

        $movieTag->update($validate);

        return response()->json([
            'status' => 'success',
            'message' => 'Updated movie tag successfully.'
        ], 200);
    }


    public function deleteMovieTag($id): JsonResponse
    {
        $movieTag = MovieTag::findOrFail($id);

        $movieTag->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted movie tag successfully.'
        ], 200);
    }


    public function getRestoreMovieTag() {
        $movieTag = MovieTag::onlyTrashed()->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Geted movie tag in trashed successfully.',
            'data' => $movieTag
        ], 200);
    }


    public function restoreMovieTag($id): JsonResponse
    {
        $movieTag = MovieTag::withTrashed()->findOrFail($id);

        $movieTag->restore();

        return response()->json([
            'status' => 'success',
            'message' => "Movie Tag 'id: $movieTag->id' restored successfully."
        ], 200);
    }
}
