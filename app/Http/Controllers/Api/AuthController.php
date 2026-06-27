<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'mensaje' => 'Credenciales incorrectas'
            ], 401);
        }

        $abilities = ['ver'];

        if ($request->permisos === 'escritura') {
            $abilities = ['ver', 'crear', 'editar', 'eliminar'];
        }

        $token = $user->createToken('api-token', $abilities)->plainTextToken;

        return response()->json([
            'usuario' => $user,
            'token'   => $token,
            'habilidades_del_token' => $abilities 
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['mensaje' => 'Sesión cerrada']);
    }

    public function perfil(Request $request)
    {
        return response()->json($request->user());
    }
}