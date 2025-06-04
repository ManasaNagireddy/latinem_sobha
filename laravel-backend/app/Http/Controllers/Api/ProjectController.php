<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json(Project::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $project = Project::create([
            'name' => $validated['name'],
        ]);

        return response()->json($project, 201);
    }

    public function show($id)
    {
        return response()->json(Project::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());
        return response()->json($project);
    }

    public function destroy($id)
    {
        Project::destroy($id);
        return response()->json(null, 204);
    }
}
