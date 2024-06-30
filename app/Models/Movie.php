<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'movie_id', 
        'title', 
        'original_title', 
        'overview', 
        'poster_path', 
        'adult', 
        'original_language', 
        'genre_ids',
        'popularity',
        'release_date',
        'video',
        'vote_average',
        'vote_count',
        'time_period',
        'production_countries',
        'origin_country',
        'production_companies',
        'spoken_languages',
        'tagline',
        'status',
        'revenue',
        'runtime'
    ];
}
