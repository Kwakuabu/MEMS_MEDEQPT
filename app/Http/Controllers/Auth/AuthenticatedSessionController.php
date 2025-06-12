<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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

        // Redirect based on the user's role
        return redirect()->intended(function () {
            if (auth()->user()->role_id == 1) { // Assuming 1 is Clinician
                return route('clinician.dashboard');
            } elseif (auth()->user()->role_id == 2) { // Assuming 2 is Technician
                return route('technician.dashboard');
            } elseif (auth()->user()->role_id == 3) { // Assuming 3 is Engineer
                return route('engineer.dashboard');
            }
            return '/'; // Fallback if no role matched
        });
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/'); // Redirect to the home page after logout
    }
}

