<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Mes reservations</h1>
    @if (session('success'))
        <div class="alert alert-success">
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
                    <button type="submit">Annuler</button>
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
                Rating: {{ $or->rating ?? 'N/A' }},
                Comment: {{ $or->comment ?? 'N/A' }}
            </li>
        @empty
            <p>No old reservations found.</p>
        @endforelse
    </ul>

</body>

</html>
