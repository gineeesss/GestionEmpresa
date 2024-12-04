<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Tarjeta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    public function update(Request $request, $ptarjeta)
    {
        //

    }

    /**
     * Obtiene el límite de la tarjeta que se introduce como parámetro
     *
     * @param $ptarjeta
     * @return \Illuminate\Http\JsonResponse
     */
    public function obtenerLimiteTarjeta($ptarjeta)
    {
//        $cliente = User::find(auth()->user()->id);
        $cliente = auth()->user();
        $enviarcliente["id"] = $cliente->id;
        $enviarcliente["name"] = $cliente->name;
        $enviarcliente["email"] = $cliente->email;
        $tarjeta = Tarjeta::where('numero', $ptarjeta)->get()->first();
        if (!$tarjeta) {
            return response()->json(['status'=> 'error 404', 'data'=>"La tarjeta no existe"],404);
        }
        if ($cliente->id == $tarjeta->cliente->id) {
            return response()->json(['status' => 'ok', "cliente" => $enviarcliente, 'tarjeta' => $ptarjeta, 'limite' => $tarjeta->limite], 200);
        } else {
            return response()->json(['status'=> 'error 403', "cliente" => $enviarcliente, 'data'=>"El propietario no coincide con el dueño de la tarjeta"],403);
        }
    }


}
