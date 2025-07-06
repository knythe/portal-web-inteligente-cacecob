<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class updateCategoriasRequest extends FormRequest
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
        $categoria = $this->route('categoria');
        $categoriaid = $categoria->id;

        return [
            'nombre' => [
                'required',
                'string',
                'max:80',
                'regex:/^[A-Za-z0-9\s]+$/',
                Rule::unique('categorias', 'nombre')->ignore($categoriaid),
            ],
            'descripcion' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto válida.',
            'nombre.max' => 'El nombre no debe tener más de 80 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras, números y espacios.',
            'nombre.unique' => 'El nombre ya está en uso.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto válida.',
        ];
    }
}
