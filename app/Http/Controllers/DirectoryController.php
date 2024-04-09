<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DirectoryController extends Controller
{
    public function getDevelopers(Request $request, $userId)
    {
        // Verificar si se pasó un ID de usuario válido
        if ($userId) {
            // Si se pasó un ID de usuario, crear una consulta para obtener todos los desarrolladores
            $devs = User::where('user_type_id', 1);

            // Obtener el usuario autenticado
            $authUser = User::find($userId);

            // Si hay un usuario autenticado, exclúyelo de la lista de desarrolladores
            if ($authUser) {
                $devs = $devs->where('id', '!=', $authUser->id);
            }

            // Obtener la lista de desarrolladores
            $devs = $devs->get();
        } else {
            // Si no se pasó un ID de usuario, obtener todos los desarrolladores
            $devs = User::where('user_type_id', 1)->get();
        }

        // Verificar si se encontraron desarrolladores
        if ($devs->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No developers found'
            ], 404);
        }

        // Devolver la lista de desarrolladores
        return response()->json([
            'success' => true,
            'data' => $devs
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
