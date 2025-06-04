<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;

class DivisionController extends Controller
{
     public function index()
    {
        return response()->json(Division::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $division = Division::create([
            'name' => $validated['name'],
        ]);

        return response()->json($division, 201);
    }

    public function show($id)
    {
        return response()->json(Division::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $division = Division::findOrFail($id);
        $division->update($request->all());
        return response()->json($division);
    }

    public function destroy($id)
    {
        Division::destroy($id);
        return response()->json(null, 204);
    }
}
