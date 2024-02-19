<x-app-layout>
    <x-slot name="slot">
        <h1>Gestion passagers</h1>
        @forelse ($passengers as $p)
            <li>
                id:{{ $p->id }}
                name: {{ $p->name }},
                email: {{ $p->email }},
                photo: {{ $p->photo_profil }},
                tel: {{ $p->tel }},
                <form action="" method="post">
                    @csrf
                    @method('DELETE')
                    <x-danger-button type="submit">delete</x-danger-button>
                </form>
            </li>
        @empty
            <p>No passengers found.</p>
        @endforelse
    </x-slot>
</x-app-layout>
