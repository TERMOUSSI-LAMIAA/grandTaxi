{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    
                    @can('driverPermission')
                        <p>hi driver.</p>
                    @endcan

                    @can('passengerPermission')
                        <p>hi passenger</p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <h1>--Trajets--</h1>

    <form method="POST" action="{{ route('trajet') }}">
        @csrf
        <label for="first_trajet_select">Select Trajet:</label>
        <select id="first_trajet_select" name="first_trajet_select">
            @foreach ($trajets as $trajet)
                <option value="{{ $trajet->id }}">
                    {{ $trajet->departure->ville }} to {{ $trajet->destination->ville }}
                </option>
            @endforeach
        </select>
        <label for="first_trajet_select">seat price:</label>
        <input type="number" name="price" id="price" min=1>
        <label for="first_trajet_select">heure depart:</label>
        <input type="time" name="hr_dep" id="hr_dep">
        <button type="submit">OK</button>
    </form>
    @if (isset($selectedTrajet) && $selectedTrajet)
        <label for="first_trajet_select">Selected Trajets:</label>
        <p>first Trajet: {{ $selectedTrajet->departure->ville }} to {{ $selectedTrajet->destination->ville }}</p>
        <p>second Trajet: {{ $reversedTrajet->departure->ville }} to {{ $reversedTrajet->destination->ville }}</p>
    @endif

</body>

</html>
