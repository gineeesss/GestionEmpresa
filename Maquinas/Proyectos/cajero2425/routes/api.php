<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TarjetaController;
use App\Http\Controllers\MovimientoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Se podrían poner todos estos métodos en un sólo controlador
// O incluso organizarlos de otra manera
Route::get('clientes/{cliente}/tarjetas/{numerotarjeta}/pin/{pin}', [TarjetaController::class, 'getLimite']);
Route::get('clientes/{cliente}/cuentas/{numerocuenta}', [CuentaController::class, 'getSaldo']);
Route::patch('clientes/{cliente}/tarjetas/{tarjeta}/pin/{pin}', [TarjetaController::class, 'update']);  // o changePin
Route::post('clientes/{cliente}/tarjetas/{tarjeta}/pin/{pin}/movimientos', [MovimientoController::class, 'sacarDinero']); // o store
Route::get('clientes/{cliente}/tarjetas/{tarjeta}/movimientos',[TarjetaController::class, 'getMovimientos']);
Route::get('clientes/{cliente}/cuentas/{cuenta}/movimientos', [MovimientoController::class, 'index']);
Route::get('clientes/{cliente}', [ClienteController::class, 'show']);





Route::apiResource('clientes',ClienteController::class)->only(['index']);
Route::apiResource('movimientos',MovimientoController::class)->only(['index']);
