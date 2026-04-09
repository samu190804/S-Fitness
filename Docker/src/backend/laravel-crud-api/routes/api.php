<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\RoutineController;

// Route::get('/user', function (Request $request) {
//    return $request->user();
// })->middleware('auth:sanctum');

// Users
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
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