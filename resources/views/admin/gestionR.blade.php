<x-app-layout>
    <x-slot name="slot">
        <div class="container mx-auto mt-8 p-4">
            <h1 class="text-3xl font-bold mb-4">Gestion Reservations</h1>

            <div class="mb-8">
                <h3 class="text-xl font-semibold">Les Reservations Recents</h3>
                <ul class="list-disc list-inside">
                    @forelse ($newReservations as $nr)
                        <li class="mb-4">
                            <strong>ID:</strong> {{ $nr->id }}<br>
                            <strong>Jour:</strong> {{ $nr->jour }}<br>
                            <strong>Total Prix:</strong> {{ $nr->total_prix }}<br>
                            <strong>Number of Seats:</strong> {{ $nr->number_of_seats }}<br>
                            <strong>Departure City:</strong> {{ $nr->taxiTrajet->trajet->departure->ville }}<br>
                            <strong>Arrival City:</strong> {{ $nr->taxiTrajet->trajet->destination->ville }}<br>
                            <strong>Departure Time:</strong> {{ $nr->taxiTrajet->hr_dep }}<br>
                            <strong>Driver:</strong><br>
                            <img src="{{ asset('storage/'.$nr->taxiTrajet->taxi->user->photo_profil) }}" alt="User Profile Image" width="100">
                            <br>
                            <strong>Taxi Immatriculation:</strong> {{ $nr->taxiTrajet->taxi->immatriculation }}<br>

                            <form action="{{ route('deleteReservation', ['reservationId' => $nr->id]) }}" method="post" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </li>
                    @empty
                        <p class="text-gray-500">No new reservations found.</p>
                    @endforelse
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-semibold">Old Reservations</h3>
                <ul class="list-disc list-inside">
                    @forelse ($oldReservations as $or)
                        <li class="mb-4">
                            <strong>ID:</strong> {{ $or->id }}<br>
                            <strong>Jour:</strong> {{ $or->jour }}<br>
                            <strong>Total Prix:</strong> {{ $or->total_prix }}<br>
                            <strong>Number of Seats:</strong> {{ $or->number_of_seats }}<br>
                            <strong>Departure City:</strong> {{ $nr->taxiTrajet->trajet->departure->ville }}<br>
                            <strong>Arrival City:</strong> {{ $nr->taxiTrajet->trajet->destination->ville }}<br>
                            <img src="{{ asset('storage/'.$nr->taxiTrajet->taxi->user->photo_profil) }}" alt="User Profile Image" style="width:100px;">
                            
                            <br>
                            <strong>Taxi Immatriculation:</strong> {{ $nr->taxiTrajet->taxi->immatriculation }}<br>
                            <strong>Rating:</strong> {{ $or->rating ?? 'Not rated' }}<br>
                            <strong>Comment:</strong> {{ $or->comment ?? 'No comment' }}<br>

                            <form action="{{ route('deleteReservation', ['reservationId' => $or->id]) }}" method="post" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </li>
                    @empty
                        <p class="text-gray-500">No old reservations found.</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </x-slot>
</x-app-layout>
