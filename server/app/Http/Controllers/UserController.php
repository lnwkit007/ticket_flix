<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function me(Request $request): JsonResponse
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => $request->user()
            ]);
        } catch (\Exception $error) {
            Log::error("Get Me Error", [
                'exception' => $error
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Get Me failed. Please try again later.'
            ], 500);
        }
    }
}
