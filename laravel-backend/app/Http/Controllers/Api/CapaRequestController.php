<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CapaRequest;

class CapaRequestController extends Controller
{
   
     public function index(Request $request)
    {
        $offset = $request->query('offset', 0); 
        $limit = $request->query('limit', 10); 
       // Start building the query
        $query = CapaRequest::query();

        // Apply filters conditionally
        $filters = ['project_id', 'division_id', 'tower_id', 'activity_id', 'sub_activity_id', 'status'];

        foreach ($filters as $filter) {
            if ($request->filled($filter)) {
                $query->where($filter, $request->query($filter));
            }
        }
        // Get total count after filters
        $total = $query->count();

        // Apply offset and limit for pagination
        $data = $query->skip($offset)->take($limit)->get();
        
        return response()->json([
            'data' => $data,
            'total' => $total,
        ]);
    }
}
