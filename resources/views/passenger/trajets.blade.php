<x-app-layout>
    <x-slot name="slot">
        <div class="flex items-center justify-center h-full flex-col mt-10">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-500 text-white px-4 py-2 rounded-md mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <h1 class="text-3xl font-semibold mb-6">Search Results</h1>

            @if ($results->isEmpty())
                <p class="text-gray-600">No results found for the selected cities.</p>
            @else
                <ul class="space-y-4">
                    @foreach ($results as $result)
                        <li class="bg-white shadow-md p-6 rounded-md">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    
                                    {{-- <span class="text-gray-600">Trajet ID:</span> {{ $result->trajet_id }}, --}}
                                    <span class="text-gray-600">From:</span> {{ $result->trajet->departure->ville }} -->
                                    <span class="text-gray-600">To:</span> {{ $result->trajet->destination->ville }},
                                    <span class="text-gray-600">Seat price:</span> {{ $result->taxi->prix }},
                                    <span class="text-gray-600">Departure Time:</span> {{ $result->hr_dep }}<br>
                                    <span class="text-gray-600">Driver:</span> {{ $result->taxi->user->name }},
                                    <span class="text-gray-600">Driver rate:</span> {{ $result->reservations->avg('rating') }}
                                </div>
                                <img src="{{ asset('storage/'.$result->taxi->user->photo_profil) }}" alt="driver_profil" class="w-16 h-16 object-cover rounded-full ml-4">
                            </div>

                            <x-secondary-button onclick="toggleAdditionalInputs({{ $result->id }})">Reserve</x-secondary-button>

                            <!-- Form with hidden additional inputs -->
                            <form id="reservationForm" action="{{ route('reserve', ['taxiTrajetId' => $result->id]) }}"
                                method="post">
                                @csrf
                                <div id="additionalInputs{{ $result->id }}" style="display: none;">
                                    <div class="mt-4">
                                        <label for="jour" class="block text-sm font-medium text-gray-600">Jour:</label>
                                        <input type="date" name="jour" id="jour{{ $result->id }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                    </div>

                                    <div class="mt-4">
                                        <label for="number_of_seats" class="block text-sm font-medium text-gray-600">Number of Seats:</label>
                                        <input type="number" name="number_of_seats" min="1" max="8"
                                            id="number_of_seats{{ $result->id }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                    </div>

                                    <x-secondary-button type="submit" class="mt-4">Confirm</x-secondary-button>
                                </div>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif

            <script>
                function toggleAdditionalInputs(resultId) {
                    var additionalInputs = document.getElementById('additionalInputs' + resultId);
                    additionalInputs.style.display = additionalInputs.style.display === 'none' ? 'block' : 'none';
                }
            </script>
        </div>
    </x-slot>
</x-app-layout>
