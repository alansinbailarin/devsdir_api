<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DirectoryController extends Controller
{
    public function getDevelopers(Request $request, $userId)
    {
        if ($userId) {
            $devs = User::where('user_type_id', 1);

            $authUser = User::find($userId);

            if ($authUser) {
                $devs = $devs->where('id', '!=', $authUser->id);
            }

            $devs = $devs->latest()->get();
        } else {
            $devs = User::where('user_type_id', 1)->latest()->get();
        }

        if ($devs->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No developers found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $devs
        ]);
    }

    public function getDeveloper(Request $request, $uuid)
    {
        $dev = User::where('uuid', $uuid)
            ->with('userInformation')
            ->first();

        if (!$dev) {
            return response()->json([
                'success' => false,
                'message' => 'Developer not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $dev
        ]);
    }

    public function getDeveloperInformation(Request $request, $userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user->userInformation
        ]);
    }

    public function getLastTwentyDevelopers(Request $request)
    {

        $devs = User::where('user_type_id', 1)
            ->where('user_status_id', 1)
            ->where('avatar', '!=', null)
            ->where('name', '!=', null)
            ->where('surname', '!=', null)
            ->whereHas('userInformation', function ($query) {
                $query->where('title', '!=', null);
            })
            ->with('userInformation')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        if ($devs->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No developers found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $devs
        ]);
    }
}
