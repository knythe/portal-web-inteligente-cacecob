<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientesRequest extends FormRequest
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
        $cliente = $this->route('cliente');
        $clienteid = $cliente->id;

        return [
            //
            'nombres' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'email' => 'required|email|unique:clientes,email,' . $clienteid,
            'dni' => 'required|string|max:8',
            'telefono' => 'required|string|max:9',
            'cargo' => 'required|string|max:30',
            'estado'    => 'nullable|integer|in:1,2,3'
        ];
    }
}
