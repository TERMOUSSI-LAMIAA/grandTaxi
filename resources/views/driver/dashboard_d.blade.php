<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <h1>Trajets</h1>

    <form method="POST" action="{{ route('dashboard_d') }}">
        @csrf
        <label for="first_trajet_select">Select Trajet:</label>
        <select id="first_trajet_select" name="first_trajet_select">
            @foreach ($trajets as $trajet)
                <option value="{{ $trajet->id }}">
                    {{ $trajet->departure->ville }} to {{ $trajet->destination->ville }}
                </option>
            @endforeach
        </select>
        <button type="submit">OK</button>
    </form>
    @if (isset($selectedTrajet) && $selectedTrajet)
        <label for="first_trajet_select">Selected Trajets:</label>
        <p>first Trajet: {{ $selectedTrajet->departure->ville }} to {{ $selectedTrajet->destination->ville }}</p>
        <p>second Trajet: {{ $reversedTrajet->departure->ville }} to {{ $reversedTrajet->destination->ville }}</p>
    @endif

</body>

</html>
