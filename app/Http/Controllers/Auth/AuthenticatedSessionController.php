<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $userType = Auth::user()->type_user;
        $isAdmin = Auth::user()->is_admin;
        // return redirect()->intended(RouteServiceProvider::HOME);
        if ($userType==="passenger" && $isAdmin===0){
            return redirect(route('dashboard_p'));
        }elseif ($userType==="driver" && $isAdmin===0){
            return redirect(route('dashboard_d'));
        }elseif ($isAdmin===1){
            return redirect(route('dashboard_a'));
        }else{
            abort(403, 'Invalid user type');
        }
  
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
