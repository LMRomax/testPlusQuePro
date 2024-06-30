<div>
    <div id="movieDetails"
        class="relative movie-card flex justify-start gap-4 px-4 py-4 mb-4
    bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="absolute" style='width: 36px; right: 8px; top: 8px;'>
            <x-dropdown width="48">
                <x-slot name="trigger">
                    <button
                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                        <img class="rounded-full object-cover" src="{{ asset('img/threedots.png') }}"
                            alt="Dropdown list" />
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link href="javascript:void(0);" onclick="displayForm()"
                        style="display: flex; align-items: center; gap: 8px;">
                        <img width="16" src="{{ asset('img/edit.png') }}" alt="Edit movie {{ $movie->title }}">
                        Modifier
                    </x-dropdown-link>

                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                    <x-dropdown-link wire:click="deleteMovie({{ $movie->id }})"
                        wire:confirm="Êtes vous sur de vouloir supprimer le film '{{ $movie->title }}' ?"
                        href="javascript:void(0);" style="display: flex; align-items: center; gap: 8px;">
                        <img width="16" src="{{ asset('img/delete.png') }}" alt="Delete movie {{ $movie->title }}">
                        Supprimer
                    </x-dropdown-link>

                </x-slot>
            </x-dropdown>
        </div>

        <div class="image">
            <img class="rounded-lg w-full"
                style="box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;"
                src="{{ env('MOVIE_DB_BASE_URL_PICTURE') }}{{ $movie->poster_path }}"
                alt="{{ $movie->original_title }}">
        </div>

        <div class="content">
            <div class="title">
                <h2 class="font-bold text-2xl mb-1">
                    {{ $movie->title }}
                </h2>

                <div class="title-infos" class="text-sm font-light">
                    {{ date('d/m/y', strtotime($movie->release_date)) }}
                    @if (strtotime($movie->release_date) > strtotime(date('Y-m-d')))
                        <span class="text-sm text-slate-400 font-light">
                            (En production)
                        </span>
                    @endif

                    <span>
                        &#9679;
                    </span>

                    @foreach (json_decode($movie->genre_ids) as $genre)
                        @if ($loop->last)
                            {{ $genre->name }}
                        @else
                            {{ $genre->name }},
                        @endif
                    @endforeach

                    <span>
                        &#9679;
                    </span>

                    {{ $movie->runtime }} minutes
                </div>
            </div>

            <div class="note mt-4">
                <div class="flex items-center justify-start flex-wrap">
                    <div class="font-bold" style="width: 80px; margin-right: 1rem;">
                        Évaluation des utilisateurs
                    </div>

                    <div class="single-chart">
                        <svg viewBox="0 0 36 36" class="circular-chart blue">
                            <path class="circle-bg" d="M18 2.0845
                              a 15.9155 15.9155 0 0 1 0 31.831
                              a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="circle" stroke-dasharray="{{ intval(round($movie->vote_average * 10)) }}, 100"
                                d="M18 2.0845
                              a 15.9155 15.9155 0 0 1 0 31.831
                              a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <text x="18" y="20.35" class="percentage">
                                {{ intval(round($movie->vote_average * 10)) }}%
                            </text>
                        </svg>
                    </div>
                </div>

                <div class="font-light text-sm text-slate-400 mt-2">
                    Sur un total de {{ $movie->vote_count }} votes
                </div>
            </div>

            <div class="synopsis mt-6">
                <div class="font-normal text-lg italic">
                    {{ $movie->tagline }}
                </div>

                <h3 class="font-bold text-xl text-slate-800 mb-2">
                    Synopsis
                </h3>

                <div class="w-full">
                    {!! nl2br($movie->overview) !!}
                </div>
            </div>
        </div>
    </div>

    <!-- include du form pour l'édition -->
    <livewire:update-movie :movie="$movie" />

    @include('alerts.alert-success')
</div>
