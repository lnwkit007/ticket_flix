<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Movie
Route::get('/movies', [MovieController::class, 'getMovies']);
Route::get('/movie/{id}', [MovieController::class, 'getMovie']);

Route::post('/admin/movie', [MovieController::class, 'createMovie']);
Route::patch('/admin/movie/{id}', [MovieController::class, 'updateMovie']);

// Ticket
Route::post('/ticket/booking', [TicketController::class, 'bookingTicket']);