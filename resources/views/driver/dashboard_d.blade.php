<x-app-layout>
    <x-slot name="slot">
        <h1>Trajets</h1>

        <form method="POST" action="{{ route('addUserTrajets') }}">
            @csrf
            <label for="first_trajet_select">Select Trajet:</label>
            <select id="first_trajet_select" name="first_trajet_select">
                @foreach ($trajets as $trajet)
                    <option value="{{ $trajet->id }}">
                        {{ $trajet->departure->ville }} to {{ $trajet->destination->ville }}
                    </option>
                @endforeach
            </select>
            <label for="first_trajet_select">seat price:</label>
            <input type="number" name="price" id="price" min=1>
            <label for="first_trajet_select">heure depart :</label>
            <input type="time" name="hr_dep" id="hr_dep">
            <button type="submit">OK</button>
        </form>
        @if (isset($selectedTrajet) && $selectedTrajet)
            <label for="first_trajet_select">Selected Trajets:</label>
            <p>first Trajet: {{ $selectedTrajet->departure->ville }} to {{ $selectedTrajet->destination->ville }}</p>
            <p>second Trajet: {{ $reversedTrajet->departure->ville }} to {{ $reversedTrajet->destination->ville }}</p>
        @endif
    </x-slot>
</x-app-layout>
