<x-app-layout>
    <x-slot name="slot">
        <div class="flex items-center justify-center h-full flex-col mt-10">
            @if (session('success'))
                <div  class="bg-green-500 text-white px-4 py-2 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-500 text-white px-4 py-2 rounded-md mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <h1 class="text-3xl font-semibold mb-6">Next Reservations</h1>

            <div class="mb-8">
                <ul class="space-y-4">
                    @forelse ($newReservations as $nr)
                        <li class="bg-white shadow-md p-6 rounded-md">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-600">From:</span>  {{ $nr->taxiTrajet->trajet->departure->ville }} -->
                                    <span class="text-gray-600">To:</span>  {{ $nr->taxiTrajet->trajet->destination->ville }},
                                    <span class="text-gray-600">Day:</span> {{ $nr->jour }},
                                    <span class="text-gray-600">Total Price:</span>  {{ $nr->total_prix }},
                                    <span class="text-gray-600">Number of Seats:</span> {{ $nr->number_of_seats }}<br>
                                    <span class="text-gray-600">Departure Time:</span>  {{ $nr->taxiTrajet->hr_dep }},
                                    <span class="text-gray-600">Driver:</span>  {{ $nr->taxiTrajet->taxi->user->name }}
                                 <form action="{{ route('cancelReservation', ['reservationId' => $nr->id]) }}" method="post" class="mt-4">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button type="submit">Annuler</x-danger-button>
                                </form>
                                </div>
                                <img src="{{ asset('storage/'.$nr->taxiTrajet->taxi->user->photo_profil) }}" alt="driver_profil" class="w-16 h-16 object-cover rounded-full ml-4">
                               
                            </div>
                        </li>
                    @empty
                        <p class="text-gray-600">No reservations found.</p>
                    @endforelse
                </ul>
            </div>

            
    </x-slot>
</x-app-layout>
