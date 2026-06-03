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
}
