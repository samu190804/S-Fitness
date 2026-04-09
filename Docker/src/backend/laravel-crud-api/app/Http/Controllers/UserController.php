<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Lista todos los usuarios en la base de datos.
     */
    public function index()
    {
        $users = User::all();
        
        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        
        // Encriptar contraseña
        $validated['Password'] = Hash::make($validated['Password']);
        
        // Si no se proporciona admin, establecer por defecto
        if (!isset($validated['admin'])) {
            $validated['admin'] = false;
        }
        
        $user = User::create($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Usuario creado correctamente',
            'data' => $user
        ], 201);
    }

    /**
     * Lista un usuario específico por su ID.
     */
    public function show($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    /**
     * Actualiza un usuario específico por su ID.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }
        
        $validated = $request->validated();
        
        // Si se proporciona nueva contraseña, encriptarla
        if (isset($validated['Password'])) {
            $validated['Password'] = Hash::make($validated['Password']);
        }
        
        $user->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Usuario actualizado correctamente',
            'data' => $user
        ]);
    }

    /**
     * Elimina un usuario específico por su ID.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }
        
        $user->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado correctamente'
        ]);
    }

    /**
     * Sube una foto de perfil para el usuario. 
     */
    public function subirFotoPerfil(Request $request)
    {
        if (!$request->hasFile('userPhoto')){
            return response()->json(['uploadOk' => 0, 'error' => 'No hay archivo']);
        }

        $file = $request->file('userPhoto');

        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower($file->getClientOriginalExtension());

        if (!in_array($ext, $allowed)){
            return response()->json(['uploadOk' => 0, 'error' => 'Tipo no permitido']);
        }

        $path = $file->store('profile-photos', 'public');

        return response()->json([
            'uploadOk' => 1,
            'path' => $path,
            'url' => Storage::url($path)
        ]);
    }

    /**
     * Verifica si el email o username ya están registrados en la base de datos.
     */
    public function verificarEmailUserName(Request $request) {
        $email = $request->input('email');
        $username = $request->input('username');
        $excludeId = $request->input('CodU');

        $emailExists = User::where('Email', $email)
            ->where('CodU', '!=', $excludeId)
            ->exists();

        if($emailExists){
            return response()->json(['resultado' => 1, 'mensaje' => 'Email ya registrado']);
        }

        $usernameExists = User::where('UserName', $username)
            ->where('CodU', '!=', $excludeId)
            ->exists();

        if ($usernameExists) {
            return response()->json(['resultado' => 1, 'mensaje' => 'Username ya registrado']);
        }

        return response()->json(['resultado' => 2, 'mensaje' => 'Disponible']);
    }
}