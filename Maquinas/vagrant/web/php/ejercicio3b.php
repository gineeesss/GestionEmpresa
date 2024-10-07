<?php
    
    $ope1 = $_REQUEST["ope1"];
    $ope2 = $_REQUEST["ope2"];
    $operacion = $_REQUEST["signo"];
 
    switch ($operacion) {
        case 'sumar':
            echo $ope1+$ope2;
            break;
        case 'restart':
            echo $ope1 - $ope2;
            break;
        case 'multiplicar':
    echo $ope1 * $ope2;
            break;
        case 'dividir':
    echo $ope1 / $ope2;
           break;
    }

?>