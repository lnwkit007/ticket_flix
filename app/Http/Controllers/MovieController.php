<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function getMovies(): JsonResponse
    {
        $movies = Movie::with('tags', 'showtimes.theater.theater_type')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'get movies successfully.',
            'data' => $movies
        ], 200);
    }


    public function getMovie($id): JsonResponse
    {
        $movie = Movie::with('showtimes.theater.theater_type')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'get movie successfully.',
            'data' => $movie
        ], 200);
    }


    public function createMovie(Request $request): JsonResponse
    {
        $request->validate([
            'movie_title' => 'required|string|min:3|max:255',
            'movie_synopsis' => 'required|string',
            'movie_poster' => 'required|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $posterPath = null;

        if ($request->hasFile('movie_poster') && $request->file('movie_poster')->isValid()) {
            $file = $request->file('movie_poster');
            $extension = $file->getClientOriginalExtension();
            
            $fileName = time() . '_' . uniqid() . '.' . $extension;

            $file->move(public_path('storage/movies'), $fileName);
            
            $posterPath = 'movies/' . $fileName;
        }

        $createMovie = Movie::create([
            'movie_title' => $request->movie_title,
            'movie_synopsis' => $request->movie_synopsis,
            'movie_poster' => $posterPath
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Created movie successfully.',
            'data' => $createMovie
        ], 201);
    }


    public function updateMovie(Request $request, $id): JsonResponse
    {
        $validate = $request->validate([
            'movie_title' => 'sometimes|string|min:3|max:255',
            'movie_synopsis' => 'sometimes|string|min:3'
        ]);

        $movie = Movie::findOrFail($id);

        $movie->update($validate);

        return response()->json([
            'status' => 'success',
            'message' => 'Update movie successfully.',
            'data' => $movie
        ], 200);
    }


    public function deleteMovie($id): JsonResponse
    {
        $movie = Movie::findOrFail($id);

        $movie->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Movie deleted (soft delete) successfull.'
        ], 200);
    }


    public function restoreMovie($id): JsonResponse
    {
        $movie = Movie::withTrashed()->findOrFail($id);

        $movie->restore();

        return response()->json([
            'status' => 'success',
            'message' => "Movie '{$movie->movie_title}' restored successfully."
        ], 200);
    }
}
