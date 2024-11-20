<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Tarjeta;
use Illuminate\Http\Request;

class TarjetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function getLimite($pcliente, $ptarjeta, $ppin)
    {
        $cliente = Cliente::find($pcliente);
        $tarjeta = Tarjeta::where('numero', $ptarjeta)->get()->first(); //devuelve una colección de un elemento y con first cogemos el primero (y único)
        if (!$tarjeta) {
            return response()->json(['status'=> 'error 404', 'data'=>"La tarjeta no existe"],404);
        }
        if ($cliente->id == $tarjeta->cliente->id) {
            if ($tarjeta->pin == $ppin) {
                return response()->json(['status' => 'ok', 'tarjeta' => $ptarjeta, 'limite' => $tarjeta->limite], 200);
            } else {
                return response()->json(['status' => 'error 403', 'data' => 'Pin erroneo'],403);
            }
        } else
            return response()->json(['status'=> 'error 403', 'data'=>"El propietario no coincide"],403);
    }

}

//http://192.168.33.10:8000/api/clientes/8/tarjetas/5559343051412565/pin/6852
