<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validate the input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
            'gender' => ['required', 'in:male,female'],
            'bio' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = $request->user();

        // Handle image upload if there is a new one
        $imagePath = $user->image;
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($imagePath) {
                Storage::delete('public/' . $imagePath);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('profile_images', 'public');
        }

        // Fill the user data
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'bio' => $request->bio,
            'image' => $imagePath,  // Store the new image path if uploaded
        ]);

        // Check if email is updated to trigger email verification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Save the user
        $user->save();

        // Redirect back with a success message
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Delete the user's profile image if exists
        if ($user->image) {
            Storage::delete('public/' . $user->image);
        }

        // Delete the user
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
