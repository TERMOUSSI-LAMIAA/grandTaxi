
<x-app-layout>
    <x-slot name="slot">
    <a href="{{route('mesReservations')}}">mes reservations</a>
    <h1>Search your road</h1>

    <form action="{{route("search")}}" method="GET">
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

        <button type="submit">Search</button>
    </form>
</x-slot>
</x-app-layout>