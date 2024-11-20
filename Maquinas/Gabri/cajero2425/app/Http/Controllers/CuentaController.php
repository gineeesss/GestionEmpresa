<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CuentaController extends Controller
{
    public function getSaldo(Request $request, $pcliente, $pcuenta) {
//        print_r($request->input('param1'));
//        print_r($request->method());
        $cliente = Cliente::find($pcliente);
//        if ($cliente == null) {
//            print("Es nulo");
//        }

        $cuenta = Cuenta::where('numero',$pcuenta)->get()->first();

//
//        print($cliente);
//        echo "<br />";
//        print($cuenta->cliente()); <-- no funciona

        if ($cliente->id == $cuenta->cliente->id) {
            $respuesta = DB::select(DB::raw("SELECT cuentas.numero as cuenta, (cuentas.saldoinicial - sum(movimientos.cantidad)) as saldo FROM cuentas
                                                LEFT JOIN tarjetas ON tarjetas.cuenta_id = cuentas.id
                                                LEFT JOIN movimientos ON movimientos.tarjeta_id = tarjetas.id
                                                GROUP BY (cuentas.id) HAVING  cuentas.id = $cuenta->id"));
            $respuesta = $respuesta[0];
            return response()->json(['status'=>'ok','data'=>$respuesta],200);

        }
    }
}


//http://192.168.33.10:8000/api/clientes/4/cuentas/ES6216485757976472569229
