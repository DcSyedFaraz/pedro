<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\WorkOrders;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $WorkOrders = WorkOrders::where('vendor_id', auth()->user()->id)
            ->whereNotIn('status', ['declined'])
            ->orderby('priority', 'asc')->get();
        // return $WorkOrders;
        return response()->json($WorkOrders, 200);
    }
    public function show($id)
    {
        $job = Job::findOrFail($id);
        return response()->json($job, 200);
    }
}
