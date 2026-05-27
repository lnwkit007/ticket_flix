<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

//////////////////////////////// No login required ////////////////////////////

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//////////////////////////////////// Users ////////////////////////////////////

// Movie
Route::get('/movies', [MovieController::class, 'getMovies']);
Route::get('/movie/{id}', [MovieController::class, 'getMovie']);


/////////////////////////////////// Login required /////////////////////////////////////////////////
Route::middleware('auth:sanctum')->group(function() {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);

    //////////////////////////////////// Users ////////////////////////////////////

    // Ticket
    Route::post('/ticket/booking', [TicketController::class, 'bookingTicket']);
    Route::get('/users/{userId}/tickets', [TicketController::class, 'getMyBookingHistory']);

    //////////////////////////////////// Admin ////////////////////////////////////

    // Movie
    Route::post('/admin/movie', [MovieController::class, 'createMovie']);
    Route::patch('/admin/movie/{id}', [MovieController::class, 'updateMovie']);

    // Showtime
    Route::post('/admin/showtime', [ShowtimeController::class, 'createShowtime']);

});