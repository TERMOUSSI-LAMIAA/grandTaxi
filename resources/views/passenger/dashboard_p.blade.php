<x-app-layout>
    <x-slot name="slot">
        <div class="flex items-center justify-center h-full flex-col mt-10">
            <h1 class="text-3xl font-semibold mb-6">Search your road</h1>

            <form action="{{ route('search') }}" method="GET" class="space-y-4">
                @csrf

                <div class="flex space-x-4">
                    <div>
                        <label for="vil_dep" class="block text-sm font-medium text-gray-600">Start city</label>
                        <select name="vil_dep" id="vil_dep" class="w-40 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @foreach ($villes as $v)
                                <option value="{{ $v->id }}">{{ $v->ville }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="vil_arv" class="block text-sm font-medium text-gray-600">End city</label>
                        <select name="vil_arv" id="vil_arv"  class="w-40 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @foreach ($villes as $v)
                                <option value="{{ $v->id }}">{{ $v->ville }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <x-primary-button type="submit" class="mt-4">Search</x-primary-button>
            </form>
        </div>
    </x-slot>
</x-app-layout>
