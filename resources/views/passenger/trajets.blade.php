<x-app-layout>
    <x-slot name="slot">
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
    <h1>Search Results</h1>

    @if ($results->isEmpty())
        <p>No results found for the selected cities.</p>
    @else
        <ul>
            @foreach ($results as $result)
                <li>
                    Taxi prix: {{ $result->taxi->prix }},
                    Trajet ID: {{ $result->trajet_id }},
                    Departure City: {{ $result->trajet->departure->ville }},
                    Arrival City: {{ $result->trajet->destination->ville }},
                    Departure Time: {{ $result->hr_dep }},
                    User: {{ $result->taxi->user->name }}
                  <img src="{{asset('storage/'.$result->taxi->user->photo_profil)}}" alt="driver_profil" width="70"> 
                    <x-secondary-button onclick="toggleAdditionalInputs({{ $result->id }})">Reserve</x-secondary-button>

                    <!-- Form with hidden additional inputs -->
                    <form id="reservationForm" action="{{ route('reserve', ['taxiTrajetId' => $result->id]) }}"
                        method="post">
                        @csrf
                        <div id="additionalInputs{{ $result->id }}" style="display: none;">
                            <label for="jour">Jour:</label>
                            <input type="date" name="jour" id="jour{{ $result->id }}" required>

                            <label for="number_of_seats">Number of Seats:</label>
                            <input type="number" name="number_of_seats" min=1 max=8
                                id="number_of_seats{{ $result->id }}" required>
                            <x-secondary-button type="submit">Confirm</x-secondary-button>
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





</x-slot>
</x-app-layout>