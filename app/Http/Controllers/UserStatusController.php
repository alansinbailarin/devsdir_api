<?php

namespace App\Http\Controllers;

use App\Models\UserStatus;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
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
