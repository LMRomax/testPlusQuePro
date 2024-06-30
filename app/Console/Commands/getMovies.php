<?php

namespace App\Console\Commands;

use App\Api\MoviesApi;
use App\Models\Movie;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Validator;

class getMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-movies {time_period}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the movies from the api and save them on the database. Need to specify a time period: day | period';

    private function getMovieDetails(object $movie): object
    {
        $api_movies = new MoviesApi();

        $movie_details = $api_movies->getMoviesById($movie->id);

        return $movie_details;
    }

    private function moviesNormalized(array $movies, string $time_period)
    {
        $movies_normalized = array();

        foreach ($movies as $movie) {
            $movie_details = $this->getMovieDetails($movie);

            $movies_normalized[] = [
                'movie_id' => $movie->id,
                'title' => $movie->title,
                'original_title' => $movie->original_title,
                'overview' => $movie->overview,
                'poster_path' => $movie->poster_path,
                'adult' => $movie->adult,
                'original_language' => $movie->original_language,
                'genre_ids' => json_encode($movie_details->genres),
                'popularity' => $movie->popularity,
                'release_date' => $movie->release_date,
                'vote_average' => $movie->vote_average,
                'vote_count' => $movie->vote_count,
                'time_period' => $time_period,
                'production_countries' => json_encode($movie_details->production_countries),
                'origin_country' => json_encode($movie_details->origin_country),
                'production_companies' => json_encode($movie_details->production_companies),
                'spoken_languages' => json_encode($movie_details->spoken_languages),
                'tagline' => $movie_details->tagline,
                'status' => $movie_details->status,
                'revenue' => $movie_details->revenue,
                'runtime' => $movie_details->runtime
            ];
        }

        return $movies_normalized;
    }

    protected function validateArguments(): ?array
    {
        $validator = Validator::make($this->arguments(), [
            'time_period' => ['required', 'in:day,week'],
        ]);

        if ($validator->fails()) {
            $this->error('The given time period is invalid. The time period attribute should be : day | week');

            collect($validator->errors()->all())
                ->each(fn ($error) => $this->line($error));
            exit;
        }

        return $validator->validated();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->validateArguments();

        Movie::where('time_period', '=', $this->argument('time_period'))->delete();

        $api_movies = new MoviesApi();

        $movies = $api_movies->getMovies($this->argument('time_period'));

        $movies = $this->moviesNormalized($movies->results, $this->argument('time_period'));

        foreach ($movies as $movie) {
            try {
                Movie::create($movie);
            } catch (Exception $e) {
                Log::error($e);
            }
        }
    }
}
