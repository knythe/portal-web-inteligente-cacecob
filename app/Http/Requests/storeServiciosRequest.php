<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeServiciosRequest extends FormRequest
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
            //
            'categoria_id' => 'required',
            'titulo' => 'required|string|max:200',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0|max:99999999.99',
            'oferta' => 'nullable|numeric|min:0|max:99999999.99',
            'modalidad' => 'required|string|max:20',
            'tipo_certificado' => 'required|string|max:30',
            'horas_academicas' => 'required|string|max:3',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',

        ];
    }
}
