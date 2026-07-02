<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieTagController;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\TheaterController;
use App\Http\Controllers\TheaterTypeController;
use App\Http\Controllers\TicketController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;




use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

//////////////////////////////// No login required ////////////////////////////

Route::post('/test-upload', function (Request $request) {

    $file = $request->file('movie_poster');

    $path = $file->storeAs(
        'movies',
        'test.jpg',
        'public'
    );

    dd($path);
});

// Auth
Route::controller(AuthController::class)->middleware('throttle:60,1')->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

//////////////////////////////////// Users ////////////////////////////////////

// Movie
Route::controller(MovieController::class)->middleware('throttle:60,1')->group(function () {
    Route::get('/movies', 'getMovies');
    Route::get('/movies/{id}', 'getMovie');
});

// MovieTag
Route::controller(MovieTagController::class)->middleware('throttle:60,1')->group(function () {
    Route::get('/movie-tags', 'getMovieTags');
});

// Showtime
Route::controller(ShowtimeController::class)->middleware('throttle:60,1')->group(function () {
    Route::get('/showtimes', 'getShowtimes');
});

// Theater
Route::controller(TheaterController::class)->middleware('throttle:60,1')->group(function () {
    Route::get('/theaters', 'getTheater');
});

// TheaterType
Route::controller(TheaterTypeController::class)->middleware('throttle:60,1')->group(function () {
    Route::get('/theater-types', 'getTheaterType');
});


/////////////////////////////////// Login required /////////////////////////////////////////////////
Route::middleware(['auth:sanctum', 'throttle:30,1'])->group(function () {

    // Auth
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout');
    });

    //////////////////////////////////// Users ////////////////////////////////////

    // Ticket
    Route::controller(TicketController::class)->group(function () {
        Route::post('/ticket/bookings', 'bookingTicket');
        Route::get('/users/my/tickets', 'getMyBookingHistory');
    });
});

//////////////////////////////////// Admin ////////////////////////////////////
Route::prefix('admin')->middleware(['auth:sanctum', IsAdmin::class, 'throttle:120,1'])->group(function () {

    // Movie
    Route::controller(MovieController::class)->group(function () {
        Route::post('/movies', 'createMovie');
        Route::patch('/movies/{id}', 'updateMovie');
        Route::delete('/movies/{id}', 'deleteMovie');
        Route::get('/movies/restore', 'getRestoreMovie');
        Route::post('/movies/{id}/restore', 'restoreMovie');
    });

    // MovieTag
    Route::controller(MovieTagController::class)->group(function () {
        Route::post('/movie-tag', 'createMovieTag');
        Route::put('/movie-tag/{id}', 'updateMovieTag');
        Route::delete('/movie-tag/{id}', 'deleteMovieTag');
        Route::get('/movie-tags/restore', 'getRestoreMovieTag');
        Route::post('/movie-tag/{id}/restore', 'restoreMovieTag');
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
        Route::post('/theater', 'createTheater');
        Route::patch('/theater/{id}', 'updateTheater');
        Route::delete('/theater/{id}', 'deleteTheater');
        Route::get('/theaters/restore', 'getRestoreTheater');
        Route::post('/theater/{id}/restore', 'restoreTheater');
    });

    // TheaterType
    Route::controller(TheaterTypeController::class)->group(function () {
        Route::post('/theater-type', 'createTheaterType');
        Route::put('/theater-type/{id}', 'updateTheaterType');
        Route::delete('/theater-type/{id}', 'deleteTheaterType');
        Route::get('/theater-types/restore', 'getRestoreTheaterType');
        Route::post('/theater-type/{id}/restore', 'restoreTheaterType');
    });
});
