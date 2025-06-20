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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $usuarioid,
            'password' => ['nullable', 'string', 'min:8', 'not_in:""'],// <-- cambiado de required a nullable
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
