<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CapaRequest;

class DashboardController extends Controller
{
   
     public function DonutChart(Request $request)
    {
        $offset = $request->query('defect_type', ''); 
        $limit = $request->query('status', 'open'); 
       // Start building the query
        $query = CapaRequest::query();
        // Apply filters conditionally
        //  { project_id: 1, division_id: 1, defect_type: 'Leak', defect_count: 3 },
        $filters = ['project_id', 'division_id','defect_type', 'status','defect_count'];
        foreach ($filters as $filter) {
            if ($request->filled($filter)) {
                $query->where($filter, $request->query($filter));
            }
        }
        $data = $query->select('project_id' , 'division_id','defect_type',\DB::raw("count(*) as defect_count"))->groupBy('project_id' , 'division_id','defect_type')->get();
        // Apply offset and limit for pagination
           
        return response()->json([
            'data' => $data
        ]);
    }
}
