<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateServiciosRequest extends FormRequest
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
        $servicio = $this->route('servicio');
        $servicioId = $servicio->id ?? null;

        return [
            'categoria_id' => 'required|exists:categorias,id',

            // Si "titulo" debe ser único, usa: 'unique:servicios,titulo,' . $servicioId
            'titulo' => 'required|string|max:200|unique:servicios,titulo,' . $servicioId,
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0|max:99999999.99',
            'oferta' => 'nullable|numeric|min:0|max:99999999.99',
            'modalidad' => 'required|string|max:20',
            'tipo_certificado' => 'required|string|max:30',
            'horas_academicas' => 'required|string|max:3',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ];
    }

    public function messages(): array
    {
        return [
            'categoria_id.required' => 'La categoría es obligatoria.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',

            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser una cadena de texto.',
            'titulo.max' => 'El título no debe superar los 200 caracteres.',
            'titulo.unique' => 'El título ya está en uso.',

            'imagen.image' => 'La imagen debe ser un archivo de imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpg, jpeg, o png.',
            'imagen.max' => 'La imagen no debe superar los 2MB.',

            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',

            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un valor numérico.',
            'precio.min' => 'El precio no puede ser negativo.',
            'precio.max' => 'El precio excede el valor permitido.',

            'oferta.numeric' => 'La oferta debe ser un valor numérico.',
            'oferta.min' => 'La oferta no puede ser negativa.',
            'oferta.max' => 'La oferta excede el valor permitido.',

            'modalidad.required' => 'La modalidad es obligatoria.',
            'modalidad.string' => 'La modalidad debe ser texto.',
            'modalidad.max' => 'La modalidad no debe superar los 20 caracteres.',

            'tipo_certificado.required' => 'El tipo de certificado es obligatorio.',
            'tipo_certificado.string' => 'El tipo de certificado debe ser texto.',
            'tipo_certificado.max' => 'El tipo de certificado no debe superar los 30 caracteres.',

            'horas_academicas.required' => 'Las horas académicas son obligatorias.',
            'horas_academicas.string' => 'Las horas académicas deben ser texto.',
            'horas_academicas.max' => 'Las horas académicas no deben superar los 3 caracteres.',

            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio no es válida.',

            'fecha_fin.required' => 'La fecha de fin es obligatoria.',
            'fecha_fin.date' => 'La fecha de fin no es válida.',
            'fecha_fin.after_or_equal' => 'La fecha de fin no puede ser anterior a la fecha de inicio.',
        ];
    }
}
