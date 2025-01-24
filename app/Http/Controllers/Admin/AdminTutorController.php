<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tutor;
use Illuminate\Http\Request;

class AdminTutorController extends Controller
{
    public function index(Request $request)
    {
        // Check if there's a search query
        $query = $request->input('search');

        if ($query) {
            // Search by name, email, or department
            $tutors = Tutor::whereNull('deleted_at')
                ->where(function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%$query%")
                      ->orWhere('email', 'LIKE', "%$query%")
                      ->orWhere('department', 'LIKE', "%$query%");
                })
                ->get();
        } else {
            // Fetch all active tutors if no search query
            $tutors = Tutor::whereNull('deleted_at')->get();
        }

        // Pass the tutors and query to the view
        return view('admin.tutors', compact('tutors', 'query'));
    }

    public function destroy($id)
    {
        // Find the tutor by ID and soft delete
        $tutor = Tutor::find($id);
        if ($tutor) {
            $tutor->deleted_at = now();
            $tutor->save();
        }

        // Redirect back to the tutor list with a success message
        return redirect()->route('admin.tutors')->with('success', 'Tutor deleted successfully.');
    }
}
