<?php

namespace App\Livewire;

use App\Models\Movie;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class SearchMovies extends Component
{
    use WithPagination;


    public $time_period_boolean = false;

    #[Url(as: 'time_window', except: '')]
    public $time_period = '';

    #[Url(as: 'search', except: '')]
    public $search = '';

    public function handleTimePeriod()
    {
        $this->resetPage();
    }

    public function deleteMovie($id)
    {
        try {
            Movie::find($id)->delete();

            session()->flash('success', 'Film supprimé.');

            $this->back();
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    public function render()
    {
        $movies_collection_day = Movie::where('time_period', '=', 'day')
        ->count();

        $movies_collection_week = Movie::where('time_period', '=', 'week')
        ->count();

        if($movies_collection_day == 0) {
            $this->time_period_boolean = true;
        }

        if ($this->time_period_boolean === true)
            $this->time_period = "week";

        if ($this->time_period_boolean === false)
            $this->time_period = "day";

        $movies_collection = Movie::whereRaw('title LIKE "%' . $this->search . '%"')
            ->where('time_period', '=', $this->time_period)
            ->orderBy('release_date', 'DESC')
            ->paginate(10);

        return view('livewire.search-movies', [
            'movies_collection' => $movies_collection,
            'movies_collection_day' => $movies_collection_day,
            'movies_collection_week' => $movies_collection_week
        ]);
    }
}
