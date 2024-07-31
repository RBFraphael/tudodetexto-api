<?php

namespace App\Http\Requests\Admin\Users;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'document_number' => 'required|regex:/[0-9]{11}/|unique:users,document_number',
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'phone' => 'regex:/[0-9]{10,11}/|nullable',
            'cellphone' => 'required|regex:/[0-9]{11}/',
            'role' => 'required|in:' . join(",", UserRole::values()),
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => __("O nome é obrigatório"),
            'first_name.string' => __("O nome precisa ser uma string"),
            'last_name.required' => __("O sobrenome é obrigatório"),
            'last_name.string' => __("O sobrenome precisa ser uma string"),
            'document_number.required' => __("O CPF é obrigatório"),
            'document_number.regex' => __("O CPF informado não é válido"),
            'document_number.unique' => __("O CPF informado já está cadastrado"),
            'birthdate.required' => __("A data de nascimento é obrigatória"),
            'birthdate.date' => __("A data de nascimento informada não é uma data válida"),
            'email.required' => __("O e-mail é obrigatório"),
            'email.email' => __("O e-mail informado não é um endereço de e-mail válido"),
            'email.unique' => __("O e-mail informado já está cadastrado"),
            'phone.regex' => __("O telefone informado não é válido"),
            'cellphone.required' => __("O celular é obrigatório"),
            'cellphone.regex' => __("O celular informado não é válido"),
            'role.required' => __("O perfil de acesso é obrigatório"),
            'role.in' => __("O perfil de acesso informado não é válido"),
        ];
    }
}
