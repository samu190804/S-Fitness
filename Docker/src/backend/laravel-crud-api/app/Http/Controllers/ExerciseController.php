<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function filter(Request $request) {
        $query = \App\Models\Exercise::query()
        ->join('usuarios', 'usuarios.CodU', '=', 'exercises.CodU')
        ->select('exercises.*', 'usuarios.Name as UserName');

        if ($request->has('Qnombre')) {
            $query->where('exercises.name', 'like', '%' . $request->Qnombre . '%');
        }

        if ($request->has('Qmusculo')) {
            $query->where('exercises.Musculo', 'like', '%' . $request->Qmusculo . '%');
        }

        if ($request->has('Qnseries') && $request->Qnseries > 0) {
            $query->where('exercises.Series', $request->Qnseries);
        }

        if ($request->has('Qnrepeticiones') && $request->Qnrepeticiones > 0) {
            $query->where('exercises.Repeticiones', $request->Qnrepeticiones);
        }

        if ($request->has('QCodU')) {
            $query->where('exercises.CodU', $request->QCodU);
        }

        return response()->json($query->get());
    }

    public function ejerciciosDeRutina($codR) {
        $ejercicios = \App\Models\Exercise::query()
        ->join('usuarios', 'usuarios.CodU', '=', 'exercises.CodU')
        ->join('routines_exercises', 'routines_exercises.CodE', '=', 'exercises.CodE')
        ->where('routines_exercises.CodR', $codR)
        ->select('exercises.*', 'usuarios.Name as UserName')
        ->get();

        return response()->json($ejercicios);
    }
}
