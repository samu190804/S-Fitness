<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExerciseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $exerciseId = $this->route('id');
        
        return [
            'Name' => 'sometimes|required|string|max:50',
            'Musculo' => 'sometimes|required|string|max:50',
            'Series' => 'sometimes|required|integer|min:1',
            'Repeticiones' => 'sometimes|required|integer|min:1',
            'Descripcion' => 'sometimes|required|string',
            'Video' => 'sometimes|required|string',
            'CodU' => 'sometimes|required|exists:usuarios,CodU'
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