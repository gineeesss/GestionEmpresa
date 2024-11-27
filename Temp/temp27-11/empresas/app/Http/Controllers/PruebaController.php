<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Empleado;

class PruebaController extends Controller
{
    public function buscaempleado($pempresa, $pempleado){
        $empresa = Empresa :: find($pempresa);
        return ($empresa->empleados[$pempleado]->nombre);
    }

    public function verempleado($pempleado)
    {
        $empleado = Empleado::find($pempleado);
        $respuesta = $empleado->nombre . "(" . $empleado->empresa->nombre . ")";
        return ($respuesta);
    }

    public function verempresas()
    {
        $empresas = Empresa::all();
        $respuesta = "";
        foreach($empresas as $empresa){
            $respuesta .= "$empresa->nombre<br>";
        }
        return $respuesta;
    }
}
