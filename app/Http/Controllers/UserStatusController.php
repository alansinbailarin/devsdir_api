<?php

namespace App\Http\Controllers;

use App\Models\UserStatus;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
    public function getStatuses(Request $request)
    {
        // Get las 20 statuses
        $statuses = UserStatus::orderBy('created_at', 'desc')->get();

        if ($statuses->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No statuses found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $statuses
        ]);
    }

    public function getStatusById(Request $request, $statusId)
    {
        $status = UserStatus::find($statusId);

        if (!$status) {
            return response()->json([
                'success' => false,
                'message' => 'Status not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $status
        ]);
    }
}
