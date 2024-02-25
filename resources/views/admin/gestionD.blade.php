<x-app-layout>
    <x-slot name="slot">
        <div class="container mx-auto mt-8 p-4">
            <h1 class="text-3xl font-bold mb-4">Gestion drivers</h1>
            <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse ($drivers as $p)
                    <li class="bg-white p-6 rounded-md shadow-md">
                        <div class="mb-2">
                            <strong>ID:</strong> {{ $p->id }}<br>
                            <strong>Name:</strong> {{ $p->name }}<br>
                            <strong>Email:</strong> {{ $p->email }}<br>
                            <strong>Description:</strong> {{ $p->description }}<br>
                            <strong>Type Paiement:</strong> {{ $p->type_paiement }}
                        </div>
                        <div class="flex items-center mb-4">
                            <img src="{{ asset("storage/".$p->photo_profil) }}" alt="driver_photo" class="w-16 h-16 object-cover rounded-full mr-2">
                            <span class="text-gray-600">{{ $p->name }}</span>
                        </div>
                        <form action="{{ route('deleteUser', ['userId' => $p->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                        </form>
                    </li>
                @empty
                    <p class="text-gray-500">No drivers found.</p>
                @endforelse
            </ul>
        </div>
    </x-slot>
</x-app-layout>
