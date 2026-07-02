<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function getMovies(): JsonResponse
    {
        try {
            $movies = Movie::with('tags', 'showtimes.theater.theater_type')->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Geted movies successfully.',
                'data' => $movies
            ], 200);
        } catch (\Exception $error) {
            Log::error('Get Movie Error : ' . $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Could not fetch movies. Please try again later.'
            ], 500);
        }
    }


    public function getMovie($id): JsonResponse
    {
        try {
            $movie = Movie::with('showtimes.theater.theater_type')->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Geted movie successfully.',
                'data' => $movie
            ], 200);
        } catch (\Exception $error) {
            Log::error('Get Movie Error : ' . $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Could not fetch movie. Please try again later.'
            ], 500);
        }
    }


    public function createMovie(Request $request): JsonResponse
    {
        $request->validate([
            'movie_title' => 'required|string|min:3|max:255',
            'movie_synopsis' => 'required|string',
            'movie_poster' => 'required|mimes:jpeg,png,jpg,webp|max:2048',
            'tags' => 'nullable',
            'tags.*' => 'exists:movie_tag,id'
        ]);

        try {
            $posterPath = null;

            if ($request->hasFile('movie_poster') && $request->file('movie_poster')->isValid()) {

                $file = $request->file('movie_poster');

                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                $posterPath = Storage::disk('public')->putFileAs(
                    'movies',
                    $file,
                    $fileName
                );
            }

            $createMovie = Movie::create([
                'movie_title' => $request->movie_title,
                'movie_synopsis' => $request->movie_synopsis,
                'movie_poster' => $posterPath
            ]);

            if ($request->has('tags')) {
                $createMovie->tags()->sync($request->tags);
            }

            $createMovie->load('tags');

            return response()->json([
                'status' => 'success',
                'message' => 'Created movie successfully.',
                'data' => $createMovie
            ], 201);
        } catch (\Exception $error) {
            Log::error("Create Movie Error : " . $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage()
            ], 500);
        }
    }


    public function updateMovie(Request $request, $id): JsonResponse
    {
        $request->validate([
            'movie_title' => 'sometimes|string|min:3|max:255',
            'movie_synopsis' => 'sometimes|string|min:3',
            'movie_poster' => 'sometimes|mimes:jpeg,png,jpg,webp|max:2048',
            'tags' => 'sometimes|array',
            'tags.*' => 'integer|exists:movie_tag,id'
        ]);

        try {
            $movie = Movie::findOrFail($id);

            $movie->update(
                $request->only(['movie_title', 'movie_synopsis'])
            );

            if ($request->has('movie_poster') && $request->file('movie_poster')->isValid()) {
                if ($movie->movie_poster) {
                    $oldPosterPath = public_path('storage/' . $movie->movie_poster);

                    if (file_exists($oldPosterPath)) {
                        unlink($oldPosterPath);
                    }
                }

                $file = $request->file('movie_poster');
                $extension = $file->getClientOriginalExtension();

                $fileName = time() . '_' . uniqid() . '.' . $extension;

                $file->move(public_path('storage/movies'), $fileName);

                $posterPath = 'movies/' . $fileName;
                $movie->update(['movie_poster' => $posterPath]);
            }

            if ($request->has('tags')) {
                $movie->tags()->sync($request->tags);
            }

            $movie->load('tags');

            return response()->json([
                'status' => 'success',
                'message' => 'Update movie successfully.',
                'data' => $movie
            ], 200);
        } catch (\Exception $error) {
            Log::error("Update Movie Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Update Movie failed. Please try again later.'
            ], 500);
        }
    }


    public function deleteMovie($id): JsonResponse
    {
        try {
            $movie = Movie::findOrFail($id);

            $movie->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Movie deleted (soft delete) successfull.'
            ], 200);
        } catch (\Exception $error) {
            Log::error("Delete Movie Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Delete movie failed. Please try again later.'
            ], 500);
        }
    }


    public function getRestoreMovie(): JsonResponse
    {
        try {
            $movie = Movie::onlyTrashed()->with('tags')->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Geted movie in trashed successfully.',
                'data' => $movie
            ], 200);
        } catch (\Exception $error) {
            Log::error("Get Restore Movie Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Could not fetch restore movie. Please try again later.'
            ], 500);
        }
    }


    public function restoreMovie($id): JsonResponse
    {
        try {
            $movie = Movie::withTrashed()->findOrFail($id);

            $movie->restore();

            return response()->json([
                'status' => 'success',
                'message' => "Movie '{$movie->movie_title}' restored successfully."
            ], 200);
        } catch (\Exception $error) {
            Log::error("Restore Movie Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Restore movie failed. Please try again later.'
            ], 500);
        }
    }
}
