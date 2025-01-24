<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Tutor;
use Hash;
use Validator;
use Auth;

class AuthController extends Controller
{

    public function showTutorRegistrationForm()
    {
        return view('auth.registerTut');
    }

    public function registerTutor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tutors_registration,email',
            'password' => 'required|string|min:8',
            'gender' => 'required|in:male,female',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number' => 'required|string|max:20',
            'department' => 'required|in:Computer Science,Cyber Security,Software Engineering',
            'bio' => 'required|string|max:1000',
            'achievements' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->route('registerFormTutor')
                             ->withErrors($validator)
                             ->withInput();
        }

        $imageName = $request->hasFile('image') ? time() . '.' . $request->image->extension() : null;
        if ($imageName) {
            $request->image->move(public_path('images'), $imageName);
        }

        $tutor = new Tutor();
        $tutor->name = $request->name;
        $tutor->email = $request->email;
        $tutor->password = Hash::make($request->password);
        $tutor->gender = $request->gender;
        $tutor->image = $imageName;
        $tutor->phone_number = $request->phone_number;
        $tutor->department = $request->department;
        $tutor->bio = $request->bio;
        $tutor->achievements = $request->achievements;
        
        if ($tutor->save()) {
            return redirect()->route('tutorDashboardLogin')->with('success', 'Registration Successful. Please Login.');
        }
        return redirect()->back()->with('error', 'There was an issue saving your details.');
    }

    public function showTutorLoginForm()
    {
        return view('auth.loginTut');
    }

    public function loginTutor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->route('tutorDashboardLogin')
                             ->withErrors($validator)
                             ->withInput();
        }

        if (Auth::guard('tutor')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('tutorDashboard');
        }

        return redirect()->route('tutorDashboardLogin')->with('error', 'Invalid credentials');
    }
}
