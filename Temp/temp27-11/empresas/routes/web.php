<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;

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

Route::get('/empresas/{empresa}/empleados/{empleado}', [PruebaController::class, 'buscaempleado']);
Route::get('/empleado/{empleado}',[PruebaController::class, 'verempleado']);
Route::get('/empresas',[PruebaController::class, 'verempresas']);
