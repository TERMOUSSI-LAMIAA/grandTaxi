<x-app-layout>
    <x-slot name="slot">

        <h1>Search your road</h1>

        <form action="{{ route('search') }}" method="GET">
            @csrf

            <label for="ville_depart">Ville Depart:</label>
            <select name="vil_dep" id="vil_dep">
                @foreach ($villes as $v)
                    <option value="{{ $v->id }}">{{ $v->ville }}</option>
                @endforeach
            </select>

            <label for="ville_arrivee">Ville Arrivee:</label>
            <select name="vil_arv" id="vil_arv">
                @foreach ($villes as $v)
                    <option value="{{ $v->id }}">{{ $v->ville }}</option>
                @endforeach
            </select>

            <x-primary-button type="submit">Search</x-primary-button>
        </form>
    </x-slot>
</x-app-layout>
