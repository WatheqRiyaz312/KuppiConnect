<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

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
        // Validate the login credentials
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Retrieve the user (including soft-deleted ones)
        $user = User::withTrashed()->where('email', $request->email)->first();

        // Check if the user exists and password is valid
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => __('Invalid credentials.'),
            ]);
        }

        // Check if the user is soft-deleted
        if ($user->trashed()) {
            return redirect()->route('account.deactivated');
        }

        // Log in the user
        Auth::login($user);

        // Regenerate the session to prevent fixation attacks
        $request->session()->regenerate();

        // Redirect based on user role
        if ($user->usertype === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->intended(route('dashboard'));
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
