<?php

namespace App\Livewire;

use App\Livewire\Forms\MovieForm;
use App\Models\Movie;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class UpdateMovie extends Component
{
    public MovieForm $form; 

    public $movie;

    public function mount(Movie $movie)
    {
        $this->movie = $movie;

        $this->form->setMovie($this->movie);
    }

    public function update()
    {
        try {
            $this->form->update();

            session()->flash('success', 'Film modifié.');
 
            $this->redirectRoute('admin.movies.show', ['id' => $this->movie->id]);
        }
        catch(Exception $e) {
            Log::error($e);
        }        
    }
 

    public function render()
    {
        return view('livewire.update-movie');
    }
}
