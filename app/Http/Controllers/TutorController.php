<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutor;
use App\Models\Module;
use App\Models\Rating;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TutorController extends Controller
{
    // Register a new tutor
    public function registerTutor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:tutors,email',
            'password' => 'required|string|min:8',
            'gender' => 'required|in:male,female',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'department' => 'required|in:Computer Science,Cyber Security,Software Engineering',
            'bio' => 'nullable|string',
            'achievements' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('registerFormTutor')
                ->withErrors($validator)
                ->withInput();
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Check if the email is already registered
        if (Tutor::where('email', $request->email)->exists()) {
            return back()->with('error', 'This email is already registered.');
        }

        // Create the tutor
        Tutor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'image' => $imagePath,
            'department' => $request->department,
            'bio' => $request->bio,
            'achievements' => $request->achievements,
        ]);

        return redirect()->route('loginTutor')->with('success', 'Registration successful! Please log in.');
    }


    // Show all tutors
    public function getAllTutors()
    {
        $tutors = Tutor::all();
        return view('tutors', compact('tutors'));
    }

    // Show a tutor's profile
    public function showProfile($tutor_id)
    {
        $tutor = Tutor::findOrFail($tutor_id);
        return view('tutorProfile', compact('tutor'));


    }

    // Tutor Dashboard
    public function showDashboard()
    {
        $tutor = Auth::guard('tutor')->user();  // Fetch the tutor details

        // Pass tutor data to the view
        return view('tutorDashboard', compact('tutor'));
    }

    public function submitRating(Request $request, Tutor $tutor)
    {

        // Check if the user is logged in and is a student
        if (!Auth::check() || Auth::user()->usertype != 'user') {
            return redirect()->route('login')->with('error', 'You must log in as a student to rate a tutor.');
        }

        // Validate the form data
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        // Save the rating to the database
        Rating::create([
            'tutor_id' => $tutor->tutor_id,
            'student_id' => Auth::id(),
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'Rating submitted successfully!');
    }

   
}

//     // Add a module
//     public function addModule(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'description' => 'required|string',
//         ]);

//         if (Auth::check() && Auth::user()->tutor) {
//             Module::create([
//                 'name' => $validated['name'],
//                 'description' => $validated['description'],
//                 'tutor_id' => Auth::user()->tutor->tutor_id,
//             ]);

//             return redirect()->route('tutorDashboard')->with('success', 'Module added successfully!');
//         }

//         return redirect()->route('tutorDashboard')->with('error', 'You must be a tutor to add a module.');
//     }
// }
