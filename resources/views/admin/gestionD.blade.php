<x-app-layout>
    <x-slot name="slot">
        <h1>Gestion drivers</h1>
        @forelse ($drivers as $p)
            <li>
                id:{{ $p->id }}
                name: {{ $p->name }},
                email: {{ $p->email }},
                photo: {{ $p->photo_profil }},
                description: {{ $p->description }},
                type_paiement: {{ $p->type_paiement }},
                <form action="{{ route('deleteUser', ['userId' => $p->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <x-danger-button type="submit">delete</x-danger-button>
                </form>
            </li>
        @empty
            <p>No drivers found.</p>
        @endforelse
    </x-slot>
</x-app-layout>
