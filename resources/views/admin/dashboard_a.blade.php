<x-app-layout>
    <x-slot name="slot">
        <div class="container mx-auto p-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Total Passengers Card -->
            <div class="bg-blue-500 text-white p-6 rounded-lg">
                <h3 class="text-xl font-semibold mb-2">Total Passengers</h3>
                <p class="text-lg">{{ $passengerCount }}</p>
            </div>

            <!-- Total Drivers Card -->
            <div class="bg-green-500 text-white p-6 rounded-lg">
                <h3 class="text-xl font-semibold mb-2">Total Drivers</h3>
                <p class="text-lg">{{ $driverCount }}</p>
            </div>

           

            <!-- Highest Driver Rate Card -->
            <div class="bg-purple-500 text-white p-6 rounded-lg">
                <h3 class="text-xl font-semibold mb-2">Highest Driver Rate</h3>
                <p class="text-lg">{{$maxAverageRates->name}}</p>
                <p class="text-lg">{{ number_format($maxAverageRates->average_rate, 1) }}</p>
            </div>
            
            <!-- lowest Driver Rate Card -->
            <div class="bg-purple-500 text-white p-6 rounded-lg">
                <h3 class="text-xl font-semibold mb-2">Lowest Driver Rate</h3>
                <p class="text-lg">{{$minAverageRateUser->name}}</p>
                <p class="text-lg">{{ number_format($minAverageRateUser->average_rate, 1) }}</p>
            </div>
        </div>
    </x-slot>
</x-app-layout>
