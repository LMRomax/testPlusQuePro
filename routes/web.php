<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.movies.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::name('admin.')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/movies', [App\Http\Controllers\Admin\MoviesController::class, 'get'])->name('movies.index');
            Route::get('/movies/show/{id}', [App\Http\Controllers\Admin\MoviesController::class, 'show'])->name('movies.show');
        });
    });
});
