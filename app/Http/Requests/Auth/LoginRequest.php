<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __("O e-mail é obrigatório"),
            'email.email' => __("O e-mail informado não é um endereço de e-mail válido"),
            'email.exists' => __("Nenhum usuário cadastrado com o e-mail informado"),
            'password.required' => __("A senha é obrigatória"),
            'password.string' => __("A senha precisa ser uma string"),
            'password.min' => __("A senha precisa ter, no mínimo, 8 caracteres")
        ];
    }
}
