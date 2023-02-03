<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\DepartamentoController;
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
Route::get('/departamento/home',[DepartamentoController::class,'index'])->name('departamento.home')->middleware('isDepartamentoLoggedIn');
Route::get('/departamento/pendientes',[DepartamentoController::class,'getPendientes'])->name('departamento.pendientes')->middleware('isDepartamentoLoggedIn');
Route::get('/departamento/datos/{num_cuenta}',[DepartamentoController::class,'getDatosAlumno'])->name('departamento.alumno.datos')->middleware('isDepartamentoLoggedIn');
Route::get('/departamento/baja/{num_cuenta}',[DepartamentoController::class,'bajaAlumno'])->name('departamento.alumno.baja')->middleware('isDepartamentoLoggedIn');
Route::get('/departamento/rechazo/{num_cuenta}',[DepartamentoController::class,'rechazoAlumno'])->name('departamento.alumno.rechazar')->middleware('isDepartamentoLoggedIn');
Route::get('/departamento/aceptar/{num_cuenta}',[DepartamentoController::class,'aceptarAlumno'])->name('departamento.alumno.aceptar')->middleware('isDepartamentoLoggedIn');

//Login y registro
Route::get('/alumno/login',[AlumnoAuthController::class,'login'])->name('alumno.login');
Route::get('/alumno/logout',[AlumnoAuthController::class,'logout'])->name('alumno.logout');
Route::post('/alumno/login/usuario',[AlumnoAuthController::class,'loginUser'])->name('alumno.login.usuario');
Route::get('/alumno/registro',[AlumnoAuthController::class,'register'])->name('alumno.register');
Route::get('/alumno/home',[AlumnoAuthController::class,'home'])->name('alumno.home')->middleware('isAlumnoLoggedIn');
Route::post('/alumno/registro/usuario',[AlumnoAuthController::class,'registerUser'])->name('alumno.register.usuario');

//Cambio de contraseña
Route::get('/alumno/cambia_contraseña',[AlumnoAuthController::class,'vistaCambioContraseña'])->name('alumno.cambia_contraseña')->middleware('isAlumnoLoggedIn');
Route::post('/alumno/cambia/confirma_contraseña',[AlumnoAuthController::class,'comfirmaContraseña'])->name('alumno.comfirma.contraseña')->middleware('isAlumnoLoggedIn');
Route::get('/alumno/cambia/contraseña/',[AlumnoAuthController::class,'cambioContraseña'])->name('alumno.cambio.contraseña')->middleware('isAlumnoLoggedIn');
Route::post('/alumno/cambia/contraseña/post',[AlumnoAuthController::class,'doCambioContraseña'])->name('alumno.cambio.contraseña.post');
