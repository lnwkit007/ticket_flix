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
}
