<?php
    $operando1 = $_REQUEST["ope1"];
    $operando2 = $_REQUEST["ope2"];
    $operacion = $_REQUEST["operacion"];

    switch($operacion) {
        case 'sumar':
            echo $operando1 + $operando2;
            break;
        case 'restar':
            echo $operando1 - $operando2;
            break;
        case 'multiplicar':
            echo $operando1 * $operando2;
            break;
        case 'dividir':
            echo $operando1 / $operando2;
            break;
    }
?>