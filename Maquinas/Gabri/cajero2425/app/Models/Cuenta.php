<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    public function tarjetas () {
        return $this->hasMany(Tarjeta::class);
    }
    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

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

