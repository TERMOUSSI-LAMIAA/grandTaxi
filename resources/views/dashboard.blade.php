<x-app-layout>
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
</x-app-layout>
{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Search your road</h1>

    <form action="{{ route('search') }}" method="GET">
        @csrf

        <label for="ville_depart">Ville Depart:</label>
        <select name="vil_dep" id="vil_dep">
            @foreach ($villes as $v)
                <option value="{{ $v->id }}">{{ $v->ville }}</option>
            @endforeach
        </select>

        <label for="ville_arrivee">Ville Arrivee:</label>
        <select name="vil_arv" id="vil_arv">
            @foreach ($villes as $v)
                <option value="{{ $v->id }}">{{ $v->ville }}</option>
            @endforeach
        </select>

        <button type="submit">Search</button>
    </form>
</body>

</html> --}}
