<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1>Search Results</h1>

    @if ($results->isEmpty())
        <p>No results found for the selected cities.</p>
    @else
        <ul>
            @foreach ($results as $result)
                <li>
                    Taxi ID: {{ $result->taxi_id }},
                    Trajet ID: {{ $result->trajet_id }},
                    Departure City: {{ $result->trajet->departure->ville }},
                    Arrival City: {{ $result->trajet->destination->ville }},
                    Departure Time: {{ $result->hr_dep }},
                    User: {{ $result->taxi->user->name }}
                    <button onclick="toggleAdditionalInputs({{ $result->id }})">Reserve</button>

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
                            <button type="submit">Confirm</button>
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






</body>

</html>
