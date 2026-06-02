<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieTagController;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\TheaterController;
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

// Showtime
Route::controller(ShowtimeController::class)->group(function () {
    Route::get('/showtimes', 'getShowtimes');
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
            Route::delete('/movie/{id}', 'deleteMovie');
            Route::get('/movies/restore', 'getRestoreMovie');
            Route::post('/movie/{id}/restore', 'restoreMovie');
        });

        // MovieTag
        Route::controller(MovieTagController::class)->group(function () {
            Route::get('/movie_tags', 'getMovieTags');
            Route::post('/movie_tag', 'createMovieTag');
            Route::put('/movie_tag/{id}', 'updateMovieTag');
            Route::delete('/movie_tag/{id}', 'deleteMovieTag');
            Route::get('/movie_tags/restore', 'getRestoreMovieTag');
            Route::post('/movie_tag/{id}/restore', 'restoreMovieTag');
        });

        // Showtime
        Route::controller(ShowtimeController::class)->group(function () {
            Route::post('/showtime', 'createShowtime');
            Route::patch('/showtime/{id}', 'updateShowtime');
            Route::delete('/showtime/{id}', 'deleteShowtime');
            Route::get('/showtimes/restore', 'getRestoreShowtime');
            Route::post('/showtime/{id}/restore', 'restoreShowtime');
        });

        // Theater
        Route::controller(TheaterController::class)->group(function () {
            Route::get('/theaters', 'getTheater');
        });
    });
});
