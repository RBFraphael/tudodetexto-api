<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordRecoveryRequest;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Models\PasswordResetToken;
use App\Models\User;

class PasswordController extends Controller
{
    public function passwordRecovery(PasswordRecoveryRequest $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();

        if ($user) {
            $passwordRecoveryToken = PasswordResetToken::create(['user_id' => $user->id]);
            return response()->json([
                'message' => __("Dados de redefinição de senha enviados para o e-mail do usuário")
            ], 201);
        } else {
            return response()->json([
                'message' => __("Usuário não encontrado")
            ], 404);
        }
    }

    public function passwordReset(PasswordResetToken $token, PasswordResetRequest $request)
    {
        $token->user->update([
            'password' => $request->password
        ]);
        $token->delete();

        return response()->json([
            'message' => __("Senha atualizada com sucesso")
        ], 200);
    }
}
