<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateUsersRequest extends FormRequest
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
        $usuario = $this->route('usuario');
        $usuarioid = $usuario->id;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\pL\s]+$/u', // Solo letras y espacios (soporta tildes y ñ)
            ],
            'email' => 'required|email|unique:users,email,' . $usuarioid,
            'password' => ['nullable', 'string', 'min:8', 'not_in:""'], // Permitir vacío, pero si se envía, debe tener mínimo 8
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            // name
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe superar los 255 caracteres.',
            'name.regex' => 'El nombre solo debe contener letras y espacios.',

            // email
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',

            // password
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.not_in' => 'La contraseña no debe estar vacía si decides cambiarla.',

            // photo
            'photo.image' => 'El archivo debe ser una imagen válida.',
            'photo.mimes' => 'La imagen debe estar en formato jpg, jpeg o png.',
            'photo.max' => 'La imagen no debe superar los 2MB.',
        ];
    }
}
