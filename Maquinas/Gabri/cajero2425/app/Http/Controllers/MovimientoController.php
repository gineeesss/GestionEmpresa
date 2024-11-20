<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuenta;


class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pcliente, $pcuenta)
    {
        //
        $cadena ="";

        $cuenta = Cuenta::whereRaw(' numero = "' . $pcuenta . '"')->get()->first();

        if ($cuenta->cliente_id == $pcliente) {
            foreach ($cuenta->tarjetas as $tarjeta) {
                foreach ($tarjeta->movimientos as $movimiento) {
                    $cadena .= "Cliente:" . $movimiento->Cliente()->nombre . " >> cuenta: ".
                        $movimiento->cuenta->numero . " >> tarjeta:  " . $movimiento->tarjeta->numero .
                        " >> cantidad: " . $movimiento->cantidad . " €<br>";
                }
            }
            return $cadena;
        }

        return "";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function movimientoCajero($ptarjeta)
    {
        // buscamos la tarjeta
        $tarjeta =  Tarjeta::find($ptarjeta);
        if(!($tarjeta)){
            // Tarjeta no existe
        } else {
            $tarjeta -> limite;
            
        }
        $movimiento = new Movimiento;
        $movimiento -> cantidad=request() -> cantidad;
        $movimiento -> tarjeta_id=$ptarjeta;
        $movimiento -> fecha=now();
        
        // Comprobamos que la cuenta existe.
        // Tiene saldo
        // No supera el límite
        // La tarjeta no ha expirado
        
        $movimiento -> save();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
