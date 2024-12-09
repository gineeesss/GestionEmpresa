<?php

namespace App\Http\Controllers\Api;

use App\Models\Cuenta;
use App\Models\Tarjeta;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    

    public function obtenerMovimientosCuenta($param_cuenta)
    {
        $micuenta = Cuenta::where("numero", $param_cuenta)->get()->first();
        $micliente = auth()->user();
        $clienteaux["id"] = $micliente->id;
        $clienteaux["name"] = $micliente->name;
        $clienteaux["email"] = $micliente->email;

        if ($micuenta->user_id == $micliente->id) {
            foreach ($micuenta->tarjetas as $tarjeta) {
                foreach ($tarjeta->movimientos as $movimiento) {
                    $movimientoaux["id"] = $movimiento->id;
                    $movimientoaux["fecha"] = $movimiento->fecha;
                    $movimientoaux["cantidad"] = $movimiento->cantidad;
                }
                $tarjetaaux["id"] = $tarjeta->id;
                $tarjetaaux["numero"] = $tarjeta->numero;
                $tarjetaaux["limite"] = $tarjeta->limite;

                $datos[] = ["tarjeta" => $tarjetaaux, "movimientos" => $movimientoaux];

            }
            return response()->json($datos);
        } else {
            return response()->json(["estado" => "error 404", "mensaje" => "El usuario no es el propietario de la cuenta"]);
        }
    }



    public function movimientosCantidadMinima($pcuenta)
    {
        $cantidad = request()->query('cantidad'); 
        $cuenta = Cuenta::where("numero", $pcuenta)->get()->first();
        if (!($cuenta)) {
            return response()->json(["estado" => "error 404", "mensaje" => "La cuenta no existe"]);
        }
        foreach ($cuenta->tarjetas as $tarjeta) {
            foreach ($tarjeta->movimientos as $movimiento) {
                if ($movimiento->cantidad > $cantidad) {
                    $movimientoaux["id"] = $movimiento->id;
                    $movimientoaux["fecha"] = $movimiento->fecha;
                    $movimientoaux["cantidad"] = $movimiento->cantidad;
                    $datos[] = ["tarjeta" => $tarjeta->numero, "movimientos" => $movimientoaux];
                }
            }
        }
        return response()->json($datos);
    }
    



    public function realizarMovimientoCajero($ptarjeta) {
        $cantidad = request()->cantidad;
        // Hay que validad que cantidad es un número

        // La tarjeta existe
        $tarjeta = Tarjeta::where("numero",$ptarjeta)->get()->first();
        if (!($tarjeta)) {
            return response()->json(['status'=> 'error 404', 'data'=>"La tarjeta no existe"],404);
        }

        // Hay que validar si el usuario es el propietario de la tarjeta
        if (auth()->user()->id != $tarjeta->cliente->id) {
            return response()->json(["status" => "error 404", "data" => "El usuario no es el propietario de la tarjeta"], 404);
        }

        // No supera el límite (si es sacar dinero)
        if (($cantidad < 0) and ($tarjeta->limite < abs($cantidad))) {
            return response()->json(['status'=> 'error 403', 'data'=>"La cantidad supera el limite de la tarjeta"],404);
        }

        // Tiene saldo
        if (($cantidad < 0) and ($tarjeta->cuenta->saldo() < abs($cantidad))) {
            return response()->json(['status'=> 'error 403', 'data'=>"La cantidad supera el saldo en la cuenta"],404);
        }

        // La fecha de validez de la tarjeta es posterior
        if (! $tarjeta->nocaducada()) {
            return response()->json(['status'=> 'error 403', 'data'=>"La tarjeta está caducada"],404);
        }

        $movimiento = new Movimiento;
        $movimiento->cantidad = request()->cantidad;
        $movimiento->tarjeta_id = $tarjeta->id;
        $movimiento->fecha = now();
        $movimiento->save();
        if ($cantidad > 0) {
            return response()->json(['status'=> 'éxito 200', 'data'=>"La cantidad se ha ingresado satisfactoriamente"],200);
        } else {
            return response()->json(['status'=> 'éxito 200', 'data'=>"La cantidad se ha extraido satisfactoriamente"],200);
        }
    }
}
