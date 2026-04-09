<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use App\Http\Requests\StoreRoutineRequest;
use App\Http\Requests\UpdateRoutineRequest;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    /**
     * Lista todas las rutinas en la base de datos.
     */
    public function index()
    {
        $routines = Routine::with('usuario', 'ejercicios')->get();
        
        return response()->json([
            'success' => true,
            'data' => $routines
        ]);
    }

    /**
     * Almacena una nueva rutina en la base de datos.
     */
    public function store(StoreRoutineRequest $request)
    {
        $validated = $request->validated();
        
        $routine = Routine::create($validated);
        
        // Si se proporcionaron ejercicios, asociarlos
        if ($request->has('ejercicios')) {
            $routine->ejercicios()->sync($request->ejercicios);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Rutina creada correctamente',
            'data' => $routine->load('ejercicios')
        ], 201);
    }

    /**
     * Lista una rutina específica por su ID.
     */
    public function show($id)
    {
        $routine = Routine::with('usuario', 'ejercicios')->find($id);
        
        if (!$routine) {
            return response()->json([
                'success' => false,
                'message' => 'Rutina no encontrada'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $routine
        ]);
    }

    /**
     * Actualiza una rutina específica por su ID.
     */
    public function update(UpdateRoutineRequest $request, $id)
    {
        $routine = Routine::find($id);
        
        if (!$routine) {
            return response()->json([
                'success' => false,
                'message' => 'Rutina no encontrada'
            ], 404);
        }
        
        $validated = $request->validated();
        $routine->update($validated);
        
        // Actualizar ejercicios si se proporcionaron
        if ($request->has('ejercicios')) {
            $routine->ejercicios()->sync($request->ejercicios);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Rutina actualizada correctamente',
            'data' => $routine->load('ejercicios')
        ]);
    }

    /**
     * Elimina una rutina específica por su ID.
     */
    public function destroy($id)
    {
        $routine = Routine::find($id);
        
        if (!$routine) {
            return response()->json([
                'success' => false,
                'message' => 'Rutina no encontrada'
            ], 404);
        }
        
        $routine->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Rutina eliminada correctamente'
        ]);
    }

    /**
     * Obtiene todas las rutinas de un usuario específico por su CodU.
     */
    public function porUsuario($codU)
    {
        $routines = Routine::where('CodU', $codU)
            ->with('ejercicios')
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $routines
        ]);
    }
}
