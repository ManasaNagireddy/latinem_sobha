<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubDivision;

class SubDivisionController extends Controller
{
     public function index()
    {
        return response()->json(SubDivision::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $subdivision = SubDivision::create([
            'name' => $validated['name'],
        ]);

        return response()->json($subdivision, 201);
    }

    public function show($id)
    {
        return response()->json(SubDivision::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $subdivision = SubDivision::findOrFail($id);
        $subdivision->update($request->all());
        return response()->json($subdivision);
    }

    public function destroy($id)
    {
        SubDivision::destroy($id);
        return response()->json(null, 204);
    }
}
