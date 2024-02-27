<x-app-layout>
    <x-slot name="slot">
        <div class="container  mx-auto my-10 p-8 bg-white rounded shadow-lg">
            <h1 class="text-3xl font-semibold mb-6">Search your road</h1>

            <form action="{{ route('search') }}" method="GET" class="space-y-4">
                @csrf

                <div class="flex space-x-4">
                    <div class="flex-1">
                        <label for="vil_dep" class="block text-sm font-medium text-gray-600">Start city</label>
                        <select name="vil_dep" id="vil_dep" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @foreach ($villes as $v)
                                <option value="{{ $v->id }}">{{ $v->ville }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex-1">
                        <label for="vil_arv" class="block text-sm font-medium text-gray-600">End city</label>
                        <select name="vil_arv" id="vil_arv" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @foreach ($villes as $v)
                                <option value="{{ $v->id }}">{{ $v->ville }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <x-primary-button type="submit"  class="mt-4 mx-auto block">Search</x-primary-button>
            </form>

            <div class="mt-8">
                <h1 class="text-2xl font-semibold mb-4">Most reserved routes</h1>
                @foreach ($mostReservedtrajets as $route)
                    <div class="bg-gray-100 p-4 rounded mb-2">
                        <p class="text-lg"><span class="font-semibold">From:</span> {{ $route->departure_city }} <span class="font-semibold">To:</span> {{ $route->destination_city }} - Total reservations: {{ $route->reservations_count }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </x-slot>
</x-app-layout>
