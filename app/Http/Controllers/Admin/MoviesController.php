<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function get() {
        return view('admin.movies.index');
    }

    public function show($id) {
        $movie = Movie::find($id);

        return view('admin.movies.show', [
            'movie' => $movie
        ]);
    }
}
