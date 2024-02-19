<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Taxi;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:passenger,driver'],
            'photo' => ['image', 'max:1024'],
            'description' => ['string', 'nullable'],
            'paiement' => ['required_if:role,driver', 'string', 'in:especes,carte'],
            'immatriculation' => ['required_if:role,driver', 'nullable', 'string', 'max:255'],
            'type_vehicule' => ['required_if:role,driver', 'nullable', 'string', 'max:255'],
            'total_seats' => ['required_if:role,driver', 'nullable', 'integer', 'between:1,7'],
            'tel' => ['required_if:role,passenger', 'nullable', 'string', 'max:255'],
        ]);



        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type_user' => $request->role,
        ];
        if ($request->hasFile('photo')) {
            $filePath = $request->file('photo')->store('imgs', 'public');
            $userData['photo_profil'] = $filePath;
        }
        if ($request->role === 'passenger') {
            $userData['tel'] = $request->tel;
        } elseif ($request->role === 'driver') {
            $userData['description'] = $request->description;
            $userData['type_paiement'] = $request->paiement;
        }

        $user = User::create($userData);

        if ($request->role === 'driver') {
            $role = 'driver';
            // $permissionNom = 'driverPermission';

        } else {
            $role = 'passenger';
            // $permissionNom = 'passengerPermission';
        }

        $userRole = Role::firstOrCreate(['name' => $role]);
        $user->assignRole($userRole);

        // $permission = Permission::where('name', $permissionNom)->first();

        // if (!$permission) {
        //     $permission = Permission::create(['name' => $permissionNom]);
        // }
        // $userRole->givePermissionTo($permission);

        $taxi = Taxi::create([
            'immatriculation' => $request->immatriculation,
            'type_vehicule' => $request->type_vehicule,
            'total_seats' => $request->total_seats,
            'prix'=>0,
            'user_id' => $user->id
        ]);
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),

        // ]);

        // --------
        // if ($request->role === 'driver') {
        //  Create and associate taxi with user
        // $taxi = Taxi::create([
        //     'immatriculation' => $request->input('immatriculation'),
        //     'type_vehicule' => $request->input('type_vehicule'),
        //     'total_seats' => $request->input('total_seats'),
        //     'user_id' => $user->id,
        // ]);
        // Associate taxi with user
        // $user->taxi()->save($taxi);

        // $user->update([
        //     'description' => $request->description,
        // 'type_paiement' => $request->paiement,
        // 'immatriculation' => $request->immatriculation,
        // 'type_vehicule' => $request->type_vehicule,
        // 'total_seats' => $request->total_seats,
        // ]);

        // Handle photo upload
        // if ($request->hasFile('photo')) {
        //     $photoPath = $request->file('photo')->store('photos', 'public');
        //     $user->update(['photo_profil' => $photoPath]);
        // }
        // }

        // Additional fields for the passenger
        // if ($request->role === 'passenger') {
        //     $user->update([
        //         'tel' => $request->tel,
        //     ]);
        //     if ($request->hasFile('photo')) {
        //         $photoPath = $request->file('photo')->store('photos', 'public');
        //         $user->update(['photo' => $photoPath]);
        //     }
        // }

        event(new Registered($user));

        Auth::login($user);

        // if($user->type == 'drvr')
        return redirect(route('dashboard_d'));

        // return redirect(route('dashboard_p'));

    }
}
