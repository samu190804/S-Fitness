<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Lista todos los ejercicios en la base de datos.
     */
    public function index()
    {
        $exercises = Exercise::with('usuario')->get();
        
        return response()->json([
            'success' => true,
            'data' => $exercises
        ]);
    }

    /**
     * Almacena un nuevo ejercicio en la base de datos.
     */
    public function store(StoreExerciseRequest $request)
    {
        $validated = $request->validated();
        
        $exercise = Exercise::create($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Ejercicio creado correctamente',
            'data' => $exercise
        ], 201);
    }

    /**
     * Lista un ejercicio específico por su ID.
     */
    public function show($id)
    {
        $exercise = Exercise::with('usuario')->find($id);
        
        if (!$exercise) {
            return response()->json([
                'success' => false,
                'message' => 'Ejercicio no encontrado'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $exercise
        ]);
    }

    /**
     * Actualiza un ejercicio específico por su ID.
     */
    public function update(UpdateExerciseRequest $request, $id)
    {
        $exercise = Exercise::find($id);
        
        if (!$exercise) {
            return response()->json([
                'success' => false,
                'message' => 'Ejercicio no encontrado'
            ], 404);
        }
        
        $validated = $request->validated();
        $exercise->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Ejercicio actualizado correctamente',
            'data' => $exercise
        ]);
    }

    /**
     * Elimina un ejercicio específico por su ID.
     */
    public function destroy($id)
    {
        $exercise = Exercise::find($id);
        
        if (!$exercise) {
            return response()->json([
                'success' => false,
                'message' => 'Ejercicio no encontrado'
            ], 404);
        }
        
        $exercise->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Ejercicio eliminado correctamente'
        ]);
    }

    /**
     * Filtra ejercicios según los parámetros de consulta proporcionados.
     */
    public function filter(Request $request) 
    {
        $query = Exercise::query()
            ->join('usuarios', 'usuarios.CodU', '=', 'exercises.CodU')
            ->select('exercises.*', 'usuarios.Name as UserName');

        if ($request->has('Qnombre')) {
            $query->where('exercises.Name', 'like', '%' . $request->Qnombre . '%');
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

        return response()->json([
            'success' => true,
            'data' => $query->get()
        ]);
    }

    /**
     *  Obtiene todos los ejercicios de una rutina específica por su CodR.
     */
    public function ejerciciosDeRutina($codR) 
    {
        $ejercicios = Exercise::query()
            ->join('usuarios', 'usuarios.CodU', '=', 'exercises.CodU')
            ->join('routines_exercises', 'routines_exercises.CodE', '=', 'exercises.CodE')
            ->where('routines_exercises.CodR', $codR)
            ->select('exercises.*', 'usuarios.Name as UserName')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $ejercicios
        ]);
    }
}