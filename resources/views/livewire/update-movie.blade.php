<div id="movieFormDetails" class="hidden">
    <div
        class="relative movie-card-form flex justify-start gap-4 px-4 py-4 mb-4
bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="image">
            <img class="w-full"
                style="box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;"
                src="{{ env('MOVIE_DB_BASE_URL_PICTURE') }}{{ $movie->poster_path }}" alt="{{ $movie->original_title }}">
        </div>

        <div class="content">
            <form id="movieDetailForm" wire:submit="update">
                <div class="title">
                    <div class="mb-3">
                        <input type="text" wire:model="form.title"
                            class="w-full lg:flex items-center text-base leading-6 text-slate-600 rounded-md
            shadow-sm py-1.5 pr-3 hover:ring-slate-600"
                            style="height: 42px;">
                        <div class="text-red-500">
                            @error('form.title')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="flex items-center gap-1 title-infos mb-3" class="text-sm font-light">
                        <input type="date" wire:model="form.release_date"
                            class="lg:flex items-center text-base leading-6 text-slate-600 rounded-md
                        shadow-sm py-1.5 pr-3 hover:ring-slate-600"
                            style="height: 42px;">
                        @if (strtotime($movie->release_date) > strtotime(date('Y-m-d')))
                            <span class="text-sm text-slate-400 font-light">
                                (En production)
                            </span>
                        @endif

                        <span class="dots">
                            &#9679;
                        </span>

                        @foreach (json_decode($movie->genre_ids) as $genre)
                            @if ($loop->last)
                                {{ $genre->name }}
                            @else
                                {{ $genre->name }},
                            @endif
                        @endforeach

                        <span class="dots">
                            &#9679;
                        </span>

                        <input type="number" wire:model="form.runtime"
                            class="lg:flex items-center text-base leading-6 text-slate-600 rounded-md
                        shadow-sm py-1.5 pr-3 hover:ring-slate-600"
                            style="height: 42px;"> minutes
                    </div>
                    <div class="text-red-500">
                        @error('form.release_date')
                            <span class="error">{{ $message }}</span>
                        @enderror

                        @error('form.runtime')
                            <span class="error">{{ $message }}</span>
                        @enderror
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
                                <path class="circle"
                                    stroke-dasharray="{{ intval(round($movie->vote_average * 10)) }}, 100" d="M18 2.0845
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

                <div class="synopsis mt-6 mb-3">
                    <div class="mb-3">
                        <input type="text" wire:model="form.tagline"
                            class="w-full lg:flex items-center text-base leading-6 text-slate-600 rounded-md
                    shadow-sm py-1.5 pr-3 hover:ring-slate-600"
                            style="height: 42px;">

                        <div class="text-red-500">
                            @error('form.tagline')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <h3 class="font-bold text-xl text-slate-800 mb-2">
                        Synopsis
                    </h3>

                    <textarea wire:model="form.overview" rows="8"
                        class="w-full lg:flex items-center text-base leading-6 text-slate-600 rounded-md
                    shadow-sm py-1.5 pr-3 hover:ring-slate-600"></textarea>
                </div>

                <div class="flex gap-2 w-full">
                    <button wire:loading.attr="disabled" class="flex rounded-lg px-4 py-4 text-white" style="background: #3c9ee5;" 
                    onclick="displayDetails('update')" type="submit">
                        <div wire:loading class="button-loader"></div>
                        Modifier
                    </button>

                    <button wire:loading.attr="disabled" class="rounded-lg px-4 py-4 text-white" style="background-color: rgb(71, 85, 105);"
                    onclick="displayDetails('cancel')">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
