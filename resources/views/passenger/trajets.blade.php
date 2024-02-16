<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

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
                    <form action="" method="post">
                        @csrf
                        <input type="hidden" name="taxi_trajet_id" value="{{ $result->id }}">
                        <button type="submit">Reserve</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif

</body>

</html>
