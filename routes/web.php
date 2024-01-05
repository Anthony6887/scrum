<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ParticipantesController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\TareasController;
use App\Http\Controllers\SprintController;

Route::get('/', function () {
    return view('principal');
});
Route::get('/login', function () {
    session_start();

    $_SESSION = array();

    session_destroy();

    return view('login');
})->name('login');
Route::get('/registro', function () {
    return view('registro');
});

Route::get('/principal/participantes',[ParticipantesController::class,'mostrarParticipantes'])->name('mostrarParticipantes');
Route::post('/principal/participantes',[ParticipantesController::class,'insertarParticipantes'])->name('insertarParticipantes');
Route::post('/participante',[ParticipantesController::class,'agregarParticipantes'])->name('agregarParticipantes');
Route::delete('/principal/participantes',[ParticipantesController::class,'eliminarParticipantes'])->name('eliminarParticipantes');
Route::get('participante',[ParticipantesController::class,'establecerParticipante'])->name('establecerParticipante');

Route::get('/principal/proyectos', [ProyectosController::class, 'mostrarProyectos'])->name('mostrarProyectos');
Route::post('/principal/proyectos',[ProyectosController::class,'insertarProyectos'])->name('insertarProyectos');
Route::put('/principal/proyectos',[ProyectosController::class,'actualizarProyectos'])->name('actualizarProyectos');
Route::delete('/principal/proyectos',[ProyectosController::class,'eliminarProyectos'])->name('eliminarProyectos');

Route::get('/principal/proyectos/tareas',[TareasController::class,'mostrarTareas'])->name('mostrarTareas');
Route::post('/principal/proyectos/tareas',[TareasController::class,'insertarTareas'])->name('insertarTareas');
Route::post('/tareas',[TareasController::class,'establecerTareas'])->name('establecerTareas');
Route::post('/sprint',[TareasController::class,'establecerSprint'])->name('establecerSprint');
Route::put('/principal/proyectos/tareas',[TareasController::class,'actualizarTareas'])->name('actualizarTareas');
Route::delete('/principal/proyectos/tareas',[TareasController::class,'eliminarTareas'])->name('eliminarTareas');

Route::post('/agregarSprint',[SprintController::class,'insertarSprint'])->name('insertarSprint');
Route::delete('/eliminarSprint',[SprintController::class,'eliminarSprint'])->name('eliminarSprint');

