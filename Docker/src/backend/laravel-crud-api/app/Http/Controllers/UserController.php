<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;

class UserController extends Controller
{
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

        $path = $file->store('public/fotos');

        return response()->json([
            'uploadOk' => 1,
            'path' => $path,
            'url' => Storage::url($path)
        ]);
    }

    public function verificarEmailUserName(Request $request) {
        $email = $request->input('email');
        $username = $request->input('username');
        $excludeId = $request->input('CodU');

        $emailExists = \App\Models\User::where('email', $email)
        ->where('id', '!=', $excludeId)
        ->exists();

        if($emailExists){
            return response()->json(['resultado' => 1, 'mensaje' => 'Email ya registrado']);
        }

        $usernameExists = \App\Models\User::where('name', $username)
        ->where('id', '!=', $excludeId)
        ->exists();

        if ($usernameExists) {
            return response()->json(['resultado' => 1, 'mensaje' => 'Username ya registrado']);
        }

        return response()->json(['resultado' => 2, 'mensaje' => 'Disponible']);
    }
}
