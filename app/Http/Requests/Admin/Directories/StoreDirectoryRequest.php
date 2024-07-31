<?php

namespace App\Http\Requests\Admin\Directories;

use Illuminate\Foundation\Http\FormRequest;

class StoreDirectoryRequest extends FormRequest
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
            'name' => 'required|string',
            'parent_directory_id' => 'nullable|exists:directories,id'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __("O nome do diretório é obrigatório"),
            'name.string' => __("O nome do diretório precisa ser uma string"),
            'parent_directory_id.exists' => __("O diretório pai informado não existe")
        ];
    }
}
