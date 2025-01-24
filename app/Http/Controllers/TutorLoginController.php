<?php
namespace App\Http\Controllers;

use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TutorLoginController extends Controller
{
    // Show the login form
    public function showTutorDashboardLoginForm()
    {
        return view('tutorDashboardLogin'); // Ensure this view exists
    }

    // Handle login
    public function tutorDashboardLogin(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Retrieve the tutor, including soft-deleted ones
        $tutor = Tutor::withTrashed()->where('email', $request->email)->first();

        // Check if the tutor exists and the password is correct
        if (!$tutor || !Hash::check($request->password, $tutor->password)) {
            return back()->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);
        }

        // Check if the tutor is soft-deleted
        if ($tutor->trashed()) {
            return redirect()->route('account.deactivated');
        }

        // Log the tutor in
        Auth::guard('tutor')->login($tutor);

        // Redirect to the tutor dashboard
        return redirect()->intended(route('tutorDashboard'));
    }
}
