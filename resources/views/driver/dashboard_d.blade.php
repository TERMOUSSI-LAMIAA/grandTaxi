<x-app-layout>
    <x-slot name="slot">    
            
        <div class="flex items-center justify-center h-screen">
            <div class="w-full max-w-md p-8 bg-white rounded-md shadow-md">
                @if (session('error'))
                <div class="bg-red-500 text-white px-4 py-2 rounded-md mb-4">
                    {{ session('error') }}
                </div>
                @endif
                @if(isset($success))
                <div class="bg-green-500 text-white px-4 py-2 rounded-md mb-4">
                        {{ $success }}
                </div>
                @endif

                <h1 class="text-3xl font-semibold mb-6">Trajets</h1>

                <form method="POST" action="{{ route('addUserTrajets') }}" class="mb-8">
                    @csrf
                    <div class="mb-4">
                        <label for="first_trajet_select" class="block text-sm font-medium text-gray-600">Select Trajet:</label>
                        <select id="first_trajet_select" name="first_trajet_select" class="w-full border rounded-md py-2 px-3">
                            @foreach ($trajets as $trajet)
                                <option value="{{ $trajet->id }}">
                                    {{ $trajet->departure->ville }} to {{ $trajet->destination->ville }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-600">Seat Price:</label>
                        <input type="number" name="price" id="price" min="1" class="w-full border rounded-md py-2 px-3">
                    </div>

                    <div class="mb-4">
                        <label for="hr_dep" class="block text-sm font-medium text-gray-600">Heure Depart:</label>
                        <input type="time" name="hr_dep" id="hr_dep" class="w-full border rounded-md py-2 px-3">
                    </div>

                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">OK</button>
                </form>

                @if (isset($selectedTrajet) && $selectedTrajet)
                    <div>
                        <label for="first_trajet_select" class="block text-sm font-medium text-gray-600">Selected Trajets:</label>
                        <p class="mb-2">First Trajet: {{ $selectedTrajet->departure->ville }} to {{ $selectedTrajet->destination->ville }}</p>
                        <p>Second Trajet: {{ $reversedTrajet->departure->ville }} to {{ $reversedTrajet->destination->ville }}</p>
                    </div>
                @endif
            </div>
        </div>
    </x-slot>
</x-app-layout>
