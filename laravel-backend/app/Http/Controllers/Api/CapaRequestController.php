<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CapaRequest;

class CapaRequestController extends Controller
{
    public function index()
    {
       $caparequest =  CapaRequest::with('user')->get();
        return response()->json($caparequest);
    }
}
