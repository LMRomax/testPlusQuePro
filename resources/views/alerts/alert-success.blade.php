@if (session('success'))
    <div class="alert alert-success font-bold text-xl">
        {{ session('success') }}
    </div>
@endif
