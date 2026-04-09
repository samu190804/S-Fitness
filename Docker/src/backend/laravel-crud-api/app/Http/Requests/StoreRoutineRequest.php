<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoutineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Name' => 'required|string|max:100',
            'Dias' => 'required|integer|min:1|max:7',
            'Duracion' => 'required|string|max:50',
            'Nivel' => 'required|string|in:principiante,intermedio,avanzado',
            'Musculos' => 'required|string|max:255',
            'Descripcion' => 'required|string',
            'CodU' => 'required|exists:usuarios,CodU',
            'ejercicios' => 'nullable|array',
            'ejercicios.*' => 'integer|exists:exercises,CodE'
        ];
    }

    public function messages(): array
    {
        return [
            'Name.required' => 'El nombre de la rutina es obligatorio',
            'Dias.required' => 'Los días son obligatorios',
            'Dias.min' => 'La rutina debe ser al menos 1 día',
            'Dias.max' => 'La rutina no puede tener más de 7 días',
            'Duracion.required' => 'La duración es obligatoria',
            'Nivel.required' => 'El nivel es obligatorio',
            'Nivel.in' => 'El nivel debe ser: principiante, intermedio o avanzado',
            'Musculos.required' => 'Los músculos son obligatorios',
            'Descripcion.required' => 'La descripción es obligatoria',
            'CodU.required' => 'El usuario es obligatorio',
            'CodU.exists' => 'El usuario especificado no existe',
            'ejercicios.array' => 'Los ejercicios deben ser un array',
            'ejercicios.*.exists' => 'Uno o más ejercicios no existen'
        ];
    }
}