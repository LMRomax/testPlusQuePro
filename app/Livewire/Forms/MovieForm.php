<?php

namespace App\Livewire\Forms;

use App\Models\Movie;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MovieForm extends Form
{
    public ?Movie $movie;

    #[Validate('required|string|max:191')]
    public $title = '';

    #[Validate('required|integer|digits_between:2,5')]
    public $runtime = '';

    #[Validate('required|date|max:10')]
    public $release_date = '';
 
    #[Validate('required|string|max:128')]
    public $tagline = '';

    #[Validate('required|string')]
    public $overview = '';

    public function setMovie(Movie $movie)
    {
        $this->movie = $movie;
 
        $this->title = $movie->title;

        $this->runtime = $movie->runtime;

        $this->release_date = $movie->release_date;

        $this->tagline = $movie->tagline;
 
        $this->overview = $movie->overview;
    }

    public function update()
    {
        $this->validate();
 
        $this->movie->update(
            $this->all()
        );
    }
}
