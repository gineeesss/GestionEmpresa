<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!isset(request()->contiene)) {
            $clientes = Cliente::all();
        } else {
            $clientes = Cliente::where("nombre", "LIKE", "%" . request()->contiene . "%")->get();
        }

        $mclientes = [];
        foreach ($clientes as $cliente) {
            $mcuentas = [];
            $mcuenta = [];
            foreach($cliente->cuentas as $cuenta){
                $mtarjetas =  [];
                foreach ($cuenta->tarjetas as $tarjeta) {
                    $mtarjetas[] = [
                        "numero" => $tarjeta->numero,
                        "pin" => $tarjeta->pin,
                        "limite" => $tarjeta->limite
                        ];
                }
                $mcuenta = [
                    "numero" => $cuenta->numero,
                    "saldoinicial" => $cuenta->saldoinicial,
                    "tarjetas" => $mtarjetas
                ];
            }
            $mcuentas[] = $mcuenta;
            $mclientes[] = ["id" => $cliente->id, "nombre" => $cliente->nombre, "cuentas" => $mcuentas];
        }
        return response()->json(['status'=>'ok','data'=>$mclientes],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cadena = "";
        $cliente = Cliente::find($id);
            $cadena .= "$cliente->id $cliente->nombre<br>";
            foreach($cliente->cuentas as $cuenta){
                $cadena .= "&nbsp;&nbsp;&nbsp;$cuenta->numero<br>Saldo inicial: $cuenta->saldoinicial<br>";
                foreach ($cuenta->tarjetas as $tarjeta) {
                    $cadena .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" .
                        "$tarjeta->numero >> $tarjeta->pin >> $tarjeta->limite €<br>";

                        foreach($tarjeta->movimientos as $movimiento) {
                            $cadena .= "Movimiento: " . $movimiento->cantidad . " €<br>";
                        }

                }
            }
        return $cadena;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
