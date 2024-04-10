<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use Illuminate\Http\Request;

class JobTypeController extends Controller
{
    public function getJobTypes(Request $request)
    {
        $jobTypes = JobType::latest()->get();

        if ($jobTypes->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No job types found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $jobTypes
        ]);
    }

    public function getJobType(Request $request, $jobTypeId)
    {
        $jobType = JobType::find($jobTypeId);

        if (!$jobType) {
            return response()->json([
                'success' => false,
                'message' => 'Job type not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $jobType
        ]);
    }
}
