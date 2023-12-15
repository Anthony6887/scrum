<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('principal');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/registro', function () {
    return view('registro');
});

Route::get('/participantes', [ParticipantesController::class, 'mostrarParticipantes'])->name('mostrarParticipantes');
Route::post('/principal/participantes', [ParticipantesController::class, 'insertarParticipantes'])->name('insertarParticipantes');
Route::put('/principal/participantes', [ParticipantesController::class, 'actualizarParticipantes'])->name('actualizarParticipantes');
Route::delete('/principal/participantes', [ParticipantesController::class, 'eliminarParticipantes'])->name('eliminarParticipantes');