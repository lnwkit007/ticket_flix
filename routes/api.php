<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

//////////////////////////////////// Users ////////////////////////////////////

// Movie
Route::get('/movies', [MovieController::class, 'getMovies']);
Route::get('/movie/{id}', [MovieController::class, 'getMovie']);

// Ticket
Route::post('/ticket/booking', [TicketController::class, 'bookingTicket']);

//////////////////////////////////// Admin ////////////////////////////////////

// movie
Route::post('/admin/movie', [MovieController::class, 'createMovie']);
Route::patch('/admin/movie/{id}', [MovieController::class, 'updateMovie']);

// showtime
Route::post('/admin/showtime', [ShowtimeController::class, 'createShowtime']);