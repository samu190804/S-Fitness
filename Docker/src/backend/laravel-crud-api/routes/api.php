<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\AuthController;

//Rutas publicas
Route::post('/login', [AuthController::class, 'login']);
Route::post('/signin', [UserController::class, 'store']);

Route::get('/exercises', [ExerciseController::class, 'index']);
Route::get('/exercises/filter', [ExerciseController::class, 'filter']);
Route::get('/exercises/routine/{codR}', [ExerciseController::class, 'ejerciciosDeRutina']);

Route::get('/routines', [RoutineController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    //Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    
    // Users
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // Exercises
    Route::get('/exercises', [ExerciseController::class, 'index']);
    Route::get('/exercises/filter', [ExerciseController::class, 'filter']);
    Route::get('/exercises/routine/{codR}', [ExerciseController::class, 'ejerciciosDeRutina']);
    Route::post('/exercises', [ExerciseController::class, 'store']);
    Route::put('/exercises/{id}', [ExerciseController::class, 'update']);
    Route::delete('/exercises/{id}', [ExerciseController::class, 'destroy']);

    // Routines
    Route::get('/routines', [RoutineController::class, 'index']);
    Route::get('/routines/{id}', [RoutineController::class, 'show']);
    Route::post('/routines', [RoutineController::class, 'store']);
    Route::put('/routines/{id}', [RoutineController::class, 'update']);
    Route::delete('/routines/{id}', [RoutineController::class, 'destroy']);
});