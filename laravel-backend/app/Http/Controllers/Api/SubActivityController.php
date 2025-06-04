<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubActivity;

class SubActivityController extends Controller
{
     public function index()
    {
        return response()->json(SubActivity::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $subactivity = SubActivity::create([
            'name' => $validated['name'],
        ]);

        return response()->json($subactivity, 201);
    }

    public function show($id)
    {
        return response()->json(SubActivity::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $subactivity = SubActivity::findOrFail($id);
        $subactivity->update($request->all());
        return response()->json($subactivity);
    }

    public function destroy($id)
    {
        SubActivity::destroy($id);
        return response()->json(null, 204);
    }
}
