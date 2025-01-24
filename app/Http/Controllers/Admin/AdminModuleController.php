<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;

class AdminModuleController extends Controller
{
    public function index(Request $request)
    {
        // Check if there's a search query
        $query = $request->input('search');

        if ($query) {
            // Search by name or description
            $modules = Module::where('name', 'LIKE', "%$query%")
                ->orWhere('description', 'LIKE', "%$query%")
                ->get();
        } else {
            // Fetch all modules if no search query
            $modules = Module::all();
        }

        return view('admin.modules', compact('modules', 'query'));
    }
}
