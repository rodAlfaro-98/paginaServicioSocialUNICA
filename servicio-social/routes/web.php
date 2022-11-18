<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\JefeDepartamentoController;
use App\Http\Controllers\DepartamentoAuthController;
use App\Http\Controllers\AlumnoAuthController;
use App\Http\Controllers\SeleccionUsuarioController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SeleccionUsuarioController::class,'seleccionPage'])->name('seleccion');
//Departamento
Route::get('/departamento/login',[DepartamentoAuthController::class,'login'])->name('departamento.login');
Route::get('/departamento/logout',[DepartamentoAuthController::class,'logout'])->name('departamento.logout');
Route::post('/departamento/login/usuario',[DepartamentoAuthController::class,'loginUser'])->name('departamento.login.usuario');
Route::get('/departamento/home',[DepartamentoAuthController::class,'home'])->name('departamento.home')->middleware('isDepartamentoLoggedIn');
//Alumno
Route::get('/alumno/login',[AlumnoAuthController::class,'login'])->name('alumno.login');
Route::get('/alumno/logout',[AlumnoAuthController::class,'logout'])->name('alumno.logout');
Route::post('/alumno/login/usuario',[AlumnoAuthController::class,'loginUser'])->name('alumno.login.usuario');
Route::get('/alumno/registro',[AlumnoAuthController::class,'formulario'])->name('alumno.formulario');
Route::get('/alumno/home',[AlumnoAuthController::class,'home'])->name('alumno.home')->middleware('isAlumnoLoggedIn');

