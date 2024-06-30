<?php

namespace App\Livewire;

use App\Models\Movie;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class HandleMovie extends Component
{
    public $movie;

    public function mount($id)
    {
        $this->movie = Movie::findOrFail($id);
    }

    public function deleteMovie($id) {
        try {
            Movie::find($id)->delete();

            session()->flash('success', 'Film supprimé.');

            $this->redirectRoute('admin.movies.index');
        }
        catch(Exception $e) {
            Log::error($e);
        }
    }

    public function render()
    {
        return view('livewire.handle-movie');
    }
}
