<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\TicketController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

//////////////////////////////// No login required ////////////////////////////

// Auth
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

//////////////////////////////////// Users ////////////////////////////////////

// Movie
Route::controller(MovieController::class)->group(function () {
    Route::get('/movies', 'getMovies');
    Route::get('/movie/{id}', 'getMovie');
});


/////////////////////////////////// Login required /////////////////////////////////////////////////
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout');
    });

    //////////////////////////////////// Users ////////////////////////////////////

    // Ticket
    Route::controller(TicketController::class)->group(function () {
        Route::post('/ticket/booking', 'bookingTicket');
        Route::get('/users/my/tickets', 'getMyBookingHistory');
    });

    //////////////////////////////////// Admin ////////////////////////////////////

    Route::prefix('admin')->middleware(IsAdmin::class)->group(function () {

        // Movie
        Route::controller(MovieController::class)->group(function () {
            Route::post('/movie', 'createMovie');
            Route::patch('/movie/{id}', 'updateMovie');
        });

        // Showtime
        Route::controller(ShowtimeController::class)->group(function () {
            Route::post('/showtime', 'createShowtime');
        });
    });
});
