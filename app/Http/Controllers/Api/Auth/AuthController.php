<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AuthController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware("auth:api", except: ['login', 'refreshToken'])
        ];
    }

    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => __("Não autorizado")], 401);
        }

        $user = auth()->user();
        User::where('id', $user->id)->update([
            'last_login' => now()
        ]);

        return $this->respondWithToken($token);
    }

    public function refreshToken(Request $request)
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function me(Request $request)
    {
        return response()->json(auth()->user());
    }

    public function logout(Request $request)
    {
        auth()->logout(true);

        return response()->json(['message' => __("Usuário deslogado com sucesso")]);
    }

    private function respondWithToken($token)
    {
        $user = auth()->user();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $user
        ]);
    }
}
