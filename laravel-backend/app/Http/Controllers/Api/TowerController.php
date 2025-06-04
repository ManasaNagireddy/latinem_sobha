<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tower;

class TowerController extends Controller
{
     public function index()
    {
        return response()->json(Tower::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $tower = Tower::create([
            'name' => $validated['name'],
        ]);

        return response()->json($tower, 201);
    }

    public function show($id)
    {
        return response()->json(Tower::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $tower = Tower::findOrFail($id);
        $tower->update($request->all());
        return response()->json($tower);
    }

    public function destroy($id)
    {
        Tower::destroy($id);
        return response()->json(null, 204);
    }
}
