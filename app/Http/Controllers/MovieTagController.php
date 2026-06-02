<?php

namespace App\Http\Controllers;

use App\Models\MovieTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MovieTagController extends Controller
{
    public function getMovieTags() : JsonResponse
    {
        $movie_tag = MovieTag::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Geted movie tag successfully.',
            'data' => $movie_tag
        ], 200);
    }
}
