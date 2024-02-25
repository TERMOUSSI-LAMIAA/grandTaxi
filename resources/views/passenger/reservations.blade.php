<x-app-layout>
    <x-slot name="slot">
        <h1>Mes reservations</h1>
        @if (session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded-md mb-4">
            {{ session('success') }}
        </div>
        @endif
     
        <h3>les reservations recents</h3>
        <ul>
            @forelse ($newReservations as $nr)
                <li>
                    id:{{ $nr->id }}
                    Jour: {{ $nr->jour }},
                    Total Prix: {{ $nr->total_prix }},
                    Number of Seats: {{ $nr->number_of_seats }},
                    Departure City: {{ $nr->taxiTrajet->trajet->departure->ville }},
                    Arrival City: {{ $nr->taxiTrajet->trajet->destination->ville }},
                    Departure Time: {{ $nr->taxiTrajet->hr_dep }},
                    User: {{ $nr->taxiTrajet->taxi->user->name }},
                    Taxi Immatriculation: {{ $nr->taxiTrajet->taxi->immatriculation }}

                    <form action="{{ route('cancelReservation', ['reservationId' => $nr->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <x-danger-button type="submit">Annuler</x-danger-button>
                    </form>
                </li>
            @empty
                <p>No new reservations found.</p>
            @endforelse
        </ul>

        <h3>Old Reservations</h3>
        <ul>
            @forelse ($oldReservations as $or)
                <li>
                    id:{{ $or->id }}
                    Jour: {{ $or->jour }},
                    Total Prix: {{ $or->total_prix }},
                    Number of Seats: {{ $or->number_of_seats }},
                    Rating: {{ $or->rating }},
                    Comment: {{ $or->comment }}
                    @if ($or->rating === null || $or->comment === null || $or->comment === '')
                        <form action="{{ route('evaluate', ['reservationId' => $or->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <label for="rating">Rating /5:</label>
                            <input type="number" name="rating" id="rating" min="1" max="5" required>

                            <label for="comment">Comment:</label>
                            <textarea name="comment" id="comment" rows="4" required></textarea>

                            <x-secondary-button type="submit">Evaluate</x-secondary-button>
                        </form>
                    @endif
                </li>
            @empty
                <p>No old reservations found.</p>
            @endforelse
        </ul>
    </x-slot>
</x-app-layout>
