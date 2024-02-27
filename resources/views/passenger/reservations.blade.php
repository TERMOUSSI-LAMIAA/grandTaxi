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

            <h1 class="text-3xl font-semibold mb-6">My Reservations</h1>

            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-4">Recent reservations</h3>
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
                        <p class="text-gray-600">No recent reservations found.</p>
                    @endforelse
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-semibold mb-4">Past reservations</h3>
                <ul class="space-y-4">
                    @forelse ($oldReservations as $or)
                        <li class="bg-white shadow-md p-6 rounded-md">
                            <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-600">From:</span>  {{ $or->taxiTrajet->trajet->departure->ville }} -->
                                <span class="text-gray-600">To:</span>  {{ $or->taxiTrajet->trajet->destination->ville }},
                                <span class="text-gray-600">Day:</span> {{ $or->jour }},
                                <span class="text-gray-600">Total Price:</span>  {{ $or->total_prix }},
                                <span class="text-gray-600">Number of Seats:</span> {{ $or->number_of_seats }}
                                <span class="text-gray-600">Departure Time:</span>  {{ $or->taxiTrajet->hr_dep }}<br>
                                <span class="text-gray-600">Driver:</span>  {{ $or->taxiTrajet->taxi->user->name }},
                                <span class="text-gray-600">Rating:</span>  {{ $or->rating }}
                                <span class="text-gray-600">Comment:</span>  {{ $or->comment }}
                                @if ($or->rating === null || $or->comment === null || $or->comment === '')
                                    <form action="{{ route('evaluate', ['reservationId' => $or->id]) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <label for="rating" class="block text-sm font-medium text-gray-600">Rating /5:</label>
                                        <input type="number" name="rating" id="rating" min="1" max="5" required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mb-2">

                                        <label for="comment" class="block text-sm font-medium text-gray-600">Comment:</label>
                                        <textarea name="comment" id="comment" rows="4" required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>

                                        <x-secondary-button type="submit" class="mt-2">Evaluate</x-secondary-button>
                                    </form>
                                @endif
                            </div>
                            <img src="{{ asset('storage/'.$or->taxiTrajet->taxi->user->photo_profil) }}" alt="driver_profil" class="w-16 h-16 object-cover rounded-full ml-4">

                            </div>
                        </li>
                    @empty
                        <p class="text-gray-600">No past reservations found.</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </x-slot>
</x-app-layout>
