<x-guest-layout>
    <form method="POST" action="{{ route('register') }}"  enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!--  photo-->
        <x-input-label for="photo" :value="__('Profil photo')" />
        <input id="photo" type="file" class="block mt-1 w-full" name="photo" accept="image/*" />
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('role')" />
            <select id="role" name="role"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                onchange="toggleFields(this.value)" required>
                <option value="passenger">Passenger</option>
                <option value="driver">Driver</option>
            </select>
        </div>
        <!-- Additional Fields for Driver -->
        <div id="driverFields" class="mt-4" style="display: none;">
            <x-input-label for="description" :value="__('description')" />
            <textarea id="description" class="block mt-1 w-full" name="description"></textarea>
            <x-input-label for="paiement" :value="__('type paiement')" />
            <select id="paiement" name="paiement"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                required>
                <option value="especes">Especes</option>
                <option value="carte">Carte</option>
            </select>
            <hr class="my-4">
            <x-input-label for="Taxi_infos" :value="__('Taxi infos')" />
            <x-input-label for="immatriculation" :value="__('immatriculation')" />
            <x-text-input id="immatriculation" class="block mt-1 w-full" type="text" name="immatriculation" />
            <x-input-label for="type_vehicule" :value="__('type vehicule')" />
            <x-text-input id="type_vehicule" class="block mt-1 w-full" type="text" name="type_vehicule" />
            <x-input-label for="total_seats" :value="__('total seats')" />
            <x-text-input id="total_seats" class="block mt-1 w-full" type="text" type="number" name="total_seats"
                min="1" max="7" />
        </div>

        <!-- Additional Fields for Passenger -->
        <div id="passengerFields" class="mt-4" style="display: none;">
            <x-input-label for="tel" :value="__('Telephone')" />
            <x-text-input id="tel" class="block mt-1 w-full" type="text" name="tel" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        function toggleFields(role) {
            const driverFields = document.getElementById('driverFields');
            const passengerFields = document.getElementById('passengerFields');

            if (role === 'driver') {
                driverFields.style.display = 'block';
                passengerFields.style.display = 'none';
            } else if (role === 'passenger') {
                driverFields.style.display = 'none';
                passengerFields.style.display = 'block';
            } else {
                driverFields.style.display = 'none';
                passengerFields.style.display = 'none';
            }
        }
    </script>
</x-guest-layout>
