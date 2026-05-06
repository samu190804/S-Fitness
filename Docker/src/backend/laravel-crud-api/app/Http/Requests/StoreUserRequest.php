<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreUserRequest extends FormRequest
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
            'Name' => 'required|string|max:50',
            'UserName' => 'required|string|max:50|unique:users,UserName',
            'Email' => 'required|email|max:100|unique:users,Email',
            'Password' => 'required|string|min:8',
            'admin' => 'boolean',
            'Img' => 'nullable|string|max:500'
        ];
    }

    public function messages(): array
    {
        return [
            'Name.required' => 'El nombre es obligatorio',
            'UserName.required' => 'El nombre de usuario es obligatorio',
            'UserName.unique' => 'El nombre de usuario ya está en uso',
            'Email.required' => 'El email es obligatorio',
            'Email.email' => 'El email debe ser válido',
            'Email.unique' => 'El email ya está registrado',
            'Password.required' => 'La contraseña es obligatoria',
            'Password.min' => 'La contraseña debe tener al menos 8 caracteres'
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors() // aquí sí saldrían tus mensajes de messages()
            ], 422)
        );
    }
}
