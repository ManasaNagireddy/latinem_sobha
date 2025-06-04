<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;

class AcitivityController extends Controller
{
     public function index()
    {
        return response()->json(Activity::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $activity = Activity::create([
            'name' => $validated['name'],
        ]);

        return response()->json($activity, 201);
    }

    public function show($id)
    {
        return response()->json(Activity::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->update($request->all());
        return response()->json($activity);
    }

    public function destroy($id)
    {
        Activity::destroy($id);
        return response()->json(null, 204);
    }
}
