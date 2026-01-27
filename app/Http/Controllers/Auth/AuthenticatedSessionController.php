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
        // User authenticate
        $request->authenticate();

        // Session regenerate
        $request->session()->regenerate();

        // ❗ Dashboard par bhejne ke bajay OTP send karna
        return redirect()->route('otp.send');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        // OTP session bhi clear karo
        $request->session()->forget('otp_verified');

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
