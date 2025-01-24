<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    public function index(Request $request)
    {
        // Check if there's a search query
        $query = $request->input('search');

        if ($query) {
            // Search by name or email
            $students = User::where('usertype', 'user')
                ->whereNull('deleted_at')
                ->where(function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%$query%")
                      ->orWhere('email', 'LIKE', "%$query%");
                })
                ->get();
        } else {
            // Fetch all active students if no search query
            $students = User::where('usertype', 'user')->whereNull('deleted_at')->get();
        }

        return view('admin.students', compact('students', 'query'));
    }

    public function destroy($id)
    {
        // Find the student by ID and soft delete
        $student = User::find($id);
        if ($student) {
            $student->deleted_at = now();
            $student->save();
        }

        return redirect()->route('admin.students')->with('success', 'Student deleted successfully.');
    }
}

