<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ParticipantesController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\TareasController;

Route::get('/', function () {
    return view('principal');
});
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/registro', function () {
    return view('registro');
});

Route::get('/principal/participantes',[ParticipantesController::class,'mostrarParticipantes'])->name('mostrarParticipantes');
Route::post('/principal/participantes',[ParticipantesController::class,'insertarParticipantes'])->name('insertarParticipantes');
Route::put('/principal/participantes',[ParticipantesController::class,'actualizarParticipantes'])->name('actualizarParticipantes');
Route::delete('/principal/participantes',[ParticipantesController::class,'eliminarParticipantes'])->name('eliminarParticipantes');

Route::get('/principal/proyectos', [ProyectosController::class, 'mostrarProyectos'])->name('mostrarProyectos');
Route::post('/principal/proyectos',[ProyectosController::class,'insertarProyectos'])->name('insertarProyectos');
Route::put('/principal/proyectos',[ProyectosController::class,'actualizarProyectos'])->name('actualizarProyectos');
Route::delete('/principal/proyectos',[ProyectosController::class,'eliminarProyectos'])->name('eliminarProyectos');

Route::get('/principal/proyectos/tareas',[TareasController::class,'mostrarTareas'])->name('mostrarTareas');
Route::post('/principal/proyectos/tareas',[TareasController::class,'insertarTareas'])->name('insertarTareas');
Route::post('/tareas',[TareasController::class,'establecerTareas'])->name('establecerTareas');
Route::put('/principal/proyectos/tareas',[TareasController::class,'actualizarTareas'])->name('actualizarTareas');
Route::delete('/principal/proyectos/tareas',[TareasController::class,'eliminarTareas'])->name('eliminarTareas');

