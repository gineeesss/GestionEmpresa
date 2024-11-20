<?php
// Arrays tienen tamaño dinámico

$mimatriz[] = 3; // Con el índice vacío se añade al final del array
$mimatriz[12] = 22; // Se añade directamente a la posición 12
$mimatriz[] = "iwjefoeiwjf"; // Podemos meter diferentes tipos en el array. Esto se añade a la posición 13 (secuencialmente después de la última posición)
$mimatriz[] = array(3,4,5); // Array dentro de otro array
var_dump($mimatriz); // var_dump da info de la variable

echo "<hr>";
echo $mimatriz[14][1]; // 4 --> posición 1 del array almacenado en la posición 14
echo "<hr>";
echo $mimatriz[7];
echo "<hr>";

$miotramatriz[][] = 3; 
$miotramatriz[0][] = 777777; 
var_dump($miotramatriz); 
