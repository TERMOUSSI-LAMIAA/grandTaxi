<x-app-layout>
    <x-slot name="slot">
        <div class="container mx-auto mt-8 p-4">
            <h1 class="text-3xl font-bold mb-4">Gestion Reservations</h1>
            <div>
                <h3 class="text-xl font-semibold mb-4">All Reservations</h3>
                <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @forelse ($reserv as $r)
                        <li class="bg-white p-6 rounded-md shadow-md">
                            <strong class="block mb-2 text-lg font-semibold">Reservation #{{ $r->id }}</strong>
                            <div class="mb-2">
                                <strong>Jour:</strong> {{ $r->jour }}<br>
                                <strong>Total Prix:</strong> {{ $r->total_prix }}<br>
                                <strong>Number of Seats:</strong> {{ $r->number_of_seats }}<br>
                                <strong>Departure City:</strong> {{ $r->taxiTrajet->trajet->departure->ville }}<br>
                                <strong>Arrival City:</strong> {{ $r->taxiTrajet->trajet->destination->ville }}<br>
                                <strong>Rating:</strong> {{ $r->rating ?? 'Not rated' }}<br>
                                <strong>Comment:</strong> {{ $r->comment ?? 'No comment' }}<br>
                            </div>
                            <div class="flex items-center">
                                <img src="{{ asset('storage/'.$r->taxiTrajet->taxi->user->photo_profil) }}" alt="User Profile Image" class="w-10 h-10 object-cover rounded-full mr-2">
                                <span class="text-gray-600">{{ $r->taxiTrajet->taxi->user->name }}</span>
                            </div>
                            <div class="mt-4">
                                <strong>Taxi Immatriculation:</strong> {{ $r->taxiTrajet->taxi->immatriculation }}<br>
                                <form action="{{ route('deleteReservation', ['reservationId' => $r->id]) }}" method="post" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                                </form>
                            </div>
                        </li>
                    @empty
                        <p class="text-gray-500">No old reservations found.</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </x-slot>
</x-app-layout>
