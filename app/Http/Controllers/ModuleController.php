<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModuleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|string',
            'time' => 'required|string',
            'resources.*' => 'file|mimes:pdf,docx,txt,pptx|max:2048', // Restrict file types and size
        ]);

        $resourcesPaths = [];
        if ($request->hasFile('resources')) {
            foreach ($request->file('resources') as $file) {
                $path = $file->store('resources', 'public');
                $resourcesPaths[] = $path;
            }
        }

        Module::create([
            'tutor_id' => auth('tutor')->id(),
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'time' => $request->time,
            'resources' => json_encode($resourcesPaths),
        ]);

        return redirect()->back()->with('success', 'Module added successfully!');
    }
}
