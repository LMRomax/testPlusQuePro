<div>
    @if ($movies_collection_day == 0 && $movies_collection_week == 0)
        <div class="font-fold text-2xl">
            Aucun résultats
        </div>
    @endif

    @if ($movies_collection_day > 0 || $movies_collection_week > 0)
        <div class="flex align-center justify-between mb-6">
            <div class="w-1/2">
                <form>
                    <div class="relative">
                        <div class="absolute" style="top: 50%; left: 8px; transform: translateY(-50%);">
                            <svg width="24" height="24" fill="none" aria-hidden="true" class="mr-3 flex-none">
                                <path d="m19 19-3.5-3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <circle cx="11" cy="11" r="6" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"></circle>
                            </svg>
                        </div>

                        <input wire:model.live.debounce.300ms="search" placeholder="Rechercher un film"
                            class="w-full lg:flex items-center text-sm leading-6 text-slate-600 rounded-md
                shadow-sm py-1.5 pr-3 hover:ring-slate-600"
                            style="height: 42px; padding-left: 42px;" type="text">
                    </div>
                </form>
            </div>

            <div>
                <form wire:click="handleTimePeriod">
                    <span class="mr-2">
                        <strong>
                            Jour
                        </strong>
                    </span>
                    <label class="switch">
                        <input type="checkbox" wire:model="time_period_boolean" 
                        @if($movies_collection_day == 0 || $movies_collection_week == 0) disabled @endif>
                        <span class="slider round"></span>
                    </label>
                    <span class="ml-2">
                        <strong>
                            Semaine
                        </strong>
                    </span>
                </form>
            </div>
        </div>

        <div wire:loading.remove @if($movies_collection_day == 0 || $movies_collection_week == 0) wire:target="search" @endif>
            <div class="grid-wrapper">
                @foreach ($movies_collection as $movie)
                    <div wire:key="{{ $movie->movie_id }}"
                        class="movie-card mb-4 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="relative image-list">
                            <div wire:click="deleteMovie({{ $movie->id }})"
                                wire:confirm="Êtes vous sur de vouloir supprimer ce film ?"
                                class="close hidden cursor-pointer absolute shadow-md rounded-full"
                                style="right: 8px; top: 8px;">
                                <img width="24px" src="{{ asset('img/delete.png') }}"
                                    alt="Delete {{ $movie->movie_id }}">
                            </div>

                            <a class="w-full h-full inline-block"
                                href="{{ route('admin.movies.show', ['id' => $movie->id]) }}">
                                <img class="inline-block w-full h-full"
                                    src="{{ env('MOVIE_DB_BASE_URL_PICTURE') }}{{ $movie->poster_path }}"
                                    alt="{{ $movie->original_title }}">
                            </a>
                        </div>
                        <div>
                            <a class="inline-block" href="{{ route('admin.movies.show', ['id' => $movie->id]) }}">
                                <div class="w-full px-4 py-2" style="word-wrap: break-word">
                                    <strong class="text-lg">
                                        {{ $movie->title }}
                                    </strong>
                                    <br>
                                    <small class="text-base">
                                        {{ date('d/m/Y', strtotime($movie->release_date)) }}
                                    </small>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>


            {{ $movies_collection->links() }}
        </div>

        <div wire:loading @if($movies_collection_day == 0 || $movies_collection_week == 0) wire:target="search" @endif 
        class="loader shadow-md"></div>
    @endif

    @include('alerts.alert-success')
</div>
