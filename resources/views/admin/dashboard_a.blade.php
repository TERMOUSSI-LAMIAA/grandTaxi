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

            <!-- Most Reserved Route Card -->
            <div class="bg-yellow-500 text-white p-6 rounded-lg">
                <h3 class="text-xl font-semibold mb-2">Most Reserved Route</h3>
                <p class="text-lg"></p>
            </div>

            <!-- Least Reserved Route Card -->
            <div class="bg-red-500 text-white p-6 rounded-lg">
                <h3 class="text-xl font-semibold mb-2">Least Reserved Route</h3>
                <p class="text-lg"></p>
            </div>

            <!-- Highest Driver Rate Card -->
            <div class="bg-purple-500 text-white p-6 rounded-lg">
                <h3 class="text-xl font-semibold mb-2">Highest Driver Rate</h3>
                <p class="text-lg"></p>
            </div>
        </div>
    </x-slot>
</x-app-layout>
