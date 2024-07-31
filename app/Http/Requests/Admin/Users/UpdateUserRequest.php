<?php

namespace App\Http\Requests\Admin\Users;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $user = $this->route("user");

        return [
            'first_name' => 'string',
            'last_name' => 'string',
            'document_number' => 'string|size:11|unique:users,document_number,' . $user->id,
            'birthdate' => 'date',
            'email' => 'email|unique:users,email,' . $user->id,
            'phone' => 'string|min:10|nullable',
            'cellphone' => 'string|size:11',
            'role' => 'in:' . join(",", UserRole::values()),
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.string' => __("O nome precisa ser uma string"),
            'last_name.string' => __("O sobrenome precisa ser uma string"),
            'document_number.string' => __("O CPF precisa ser uma string"),
            'document_number.size' => __("O CPF precisa ter 11 caracteres"),
            'document_number.unique' => __("O CPF informado já está cadastrado"),
            'birthdate.date' => __("A data de nascimento informada não é uma data válida"),
            'email.email' => __("O e-mail informado não é um endereço de e-mail válido"),
            'email.unique' => __("O e-mail informado já está cadastrado"),
            'phone.string' => __("O telefone precisa ser uma string"),
            'phone.min' => __("O telefone precisa ter, no mínimo, 10 caracteres"),
            'cellphone.string' => __("O celular precisa ser uma string"),
            'cellphone.size' => __("O celular precisa ter 11 caracteres"),
            'role.in' => __("O perfil de acesso informado não é válido"),
        ];
    }
}
