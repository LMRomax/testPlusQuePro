<?php

namespace App\Api;

class MoviesApi
{
    public function getMovies($time_window)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.themoviedb.org/3/trending/movie/'. $time_window .'?language=fr-FR', [
            'headers' => [
                'Authorization' => 'Bearer '.env('MOVIE_DB_API_KEY'),
                'accept' => 'application/json',
            ],
        ]);

        $result = json_decode($response->getBody());

        return $result;
    }

    public function getMoviesById($id)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/'. $id .'?language=fr_FR', [
            'headers' => [
                'Authorization' => 'Bearer '.env('MOVIE_DB_API_KEY'),
                'accept' => 'application/json',
            ],
        ]);

        $result = json_decode($response->getBody());

        return $result;
    }
}
