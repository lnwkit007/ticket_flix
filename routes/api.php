<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//////////////////////////////////// Users ////////////////////////////////////

// Movie
Route::get('/movies', [MovieController::class, 'getMovies']);
Route::get('/movie/{id}', [MovieController::class, 'getMovie']);

// Ticket
Route::post('/ticket/booking', [TicketController::class, 'bookingTicket'])->middleware('auth:sanctum');
Route::get('/users/{userId}/tickets', [TicketController::class, 'getMyBookingHistory'])->middleware('auth:sanctum');

//////////////////////////////////// Admin ////////////////////////////////////

// movie
Route::post('/admin/movie', [MovieController::class, 'createMovie'])->middleware('auth:sanctum');
Route::patch('/admin/movie/{id}', [MovieController::class, 'updateMovie'])->middleware('auth:sanctum');

// showtime
Route::post('/admin/showtime', [ShowtimeController::class, 'createShowtime'])->middleware('auth:sanctum');