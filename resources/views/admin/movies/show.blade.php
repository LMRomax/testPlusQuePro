<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $movie->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:handle-movie :id="$movie->id" />
        </div>
    </div>
</x-app-layout>

<script>
    function displayForm() {
        document.getElementById("movieDetails").classList.add('hidden');
        document.getElementById("movieFormDetails").classList.remove('hidden');
    }

    // method sert à différencier le clicl sur annuler ou modifier
    function displayDetails(method) {
        if (method == "cancel") {
            event.preventDefault();

            document.getElementById("movieDetails").classList.remove('hidden');
            document.getElementById("movieFormDetails").classList.add('hidden');
        }


        if (method == "update") {
            setTimeout(() => {
                document.getElementById("movieDetails").classList.remove('hidden');
                document.getElementById("movieFormDetails").classList.add('hidden');
            }, 1500);
        }
    }
</script>
