<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    public function createShowtime(Request $request) : JsonResponse
    {
        $request->validate([]);
    }
}
