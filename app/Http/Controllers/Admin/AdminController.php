<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tutor;
use App\Models\User;
use App\Models\Module;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Fetch active tutors
        $activeTutors = Tutor::whereNull('deleted_at')->count();

        // Fetch active students
        $activeStudents = User::where('usertype', 'user')->whereNull('deleted_at')->count();

        // Fetch total modules
        $modules = Module::count();

        return view('admin.dashboard', compact('activeTutors', 'activeStudents', 'modules'));
    }
}
