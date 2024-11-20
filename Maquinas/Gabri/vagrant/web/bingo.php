<?php
echo "Números del 1 al 99 ordenados:<br>";

for ($i=0; $i < 99; $i++) {
    $bingoinicial[$i] = $i + 1;
    echo $bingoinicial[$i] . " ";
}

echo "<hr>";

// Pasamos los números del array inicial a un nuevo array, desordenados aleatoriamente (pero sin usar la función shuffle()). Con esto estamos vaciando el primer array, porque estamos sacando cada número hasta que ya no contiene nada. 
echo "Números del 1 al 99 desordenados:<br>";

for ($i=0; $i < 99; $i++) {
    $bolaactual = random_int(0, sizeof($bingoinicial) - 1);
    // No sería estrictamente necesario meterlo en un array nuevo, podríamos simplemente imprimir el valor
    $bingo[$i] = $bingoinicial[$bolaactual];
    // Del array inicial eliminamos la posición de la bola actual, solo eliminamos esa posición, y no la reemplazamos con nada. Los índices de los valores que quedan se reorganizan para seguir en orden secuencial. De este modo, no podemos volver a sacar la misma bola, y el tamaño del array inicial va disminuyendo
    array_splice($bingoinicial, $bolaactual, 1);
    echo $bingo[$i] . " ";
}

echo "<hr>";
echo "El array inicial queda vacío:<br>";
print_r($bingoinicial);

// No confundir array_slice() con array_splice()
// También podemos tirar de unset() y array_values()