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
        $data = CapaRequest::skip($offset)->take($limit)->get();
        $total = CapaRequest::count(); // get total count

        return response()->json([
            'data' => $data,
            'total' => $total,
        ]);
    }
}
