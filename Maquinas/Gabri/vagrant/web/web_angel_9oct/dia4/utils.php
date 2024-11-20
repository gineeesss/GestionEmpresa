<?php

$MINUMERO = 44;

function factorial($n) {
    // Verificar si n es 0 o 1, ya que el factorial de ambos es 1
    if ($n <= 1) {
        return 1;
    }
    // Llamada recursiva
    return $n * factorial($n - 1);
}

function suma($sum1, $sum2=99) {
    return $sum1 + $sum2;
}