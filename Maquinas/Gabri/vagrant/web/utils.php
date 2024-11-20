<?php
$MINUMERO = 5;

function factorial($n) {
    // Verificar si n es 0 o 1, ya que el factorial de ambos es 1
    if ($n <= 1) {
    return 1;
    }
    // Llamada recursiva (la función se llama a sí misma)
    return $n * factorial($n - 1);
}

function suma($sum1, $sum2 = 99) {
    return $sum1 + $sum2;
}