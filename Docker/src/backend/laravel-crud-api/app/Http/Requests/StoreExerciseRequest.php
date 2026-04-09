<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExerciseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Name' => 'required|string|max:50',
            'Musculo' => 'required|string|max:50',
            'Series' => 'required|integer|min:1',
            'Repeticiones' => 'required|integer|min:1',
            'Descripcion' => 'required|string',
            'Video' => 'required|string',
            'CodU' => 'required|exists:usuarios,CodU'
        ];
    }

    public function messages(): array
    {
        return [
            'Name.required' => 'El nombre del ejercicio es obligatorio',
            'Musculo.required' => 'El músculo es obligatorio',
            'Series.required' => 'Las series son obligatorias',
            'Series.min' => 'Las series deben ser al menos 1',
            'Repeticiones.required' => 'Las repeticiones son obligatorias',
            'Repeticiones.min' => 'Las repeticiones deben ser al menos 1',
            'Descripcion.required' => 'La descripción es obligatoria',
            'Video.required' => 'El video es obligatorio',
            'CodU.required' => 'El usuario es obligatorio',
            'CodU.exists' => 'El usuario especificado no existe'
        ];
    }
}