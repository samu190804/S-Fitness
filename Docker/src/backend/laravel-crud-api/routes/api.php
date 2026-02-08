<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//    return $request->user();
// })->middleware('auth:sanctum');

Route::get('/', function () {
    return 'Starter Query';
});

Route::get('/filter/{filters}', function ($filters) {
    return "Filtro aplicado: " . $filters;
});

Route::get('/ExerRoutine', function () {
    return 'Exercises from Routines';
});

Route::post('/InsertUser', function () {
    return 'User Created';
});

Route::put('/UpdateUser/{id}', function () {
    return 'User Updated';
});

Route::post('/InsertExer', function () {
    return 'Exer Created';
})

;Route::post('/InsertRoutine', function () {
    return 'Routine Created';
});

Route::delete('/DeleteExer/{id}', function () {
    return 'Exer Deleted';
})

;Route::delete('/DeleteRoutine/{id}', function () {
    return 'Routine Deleted';
});
