<?php

// acordaos de include a secas!!!
include_once "utils.php";
include_once "utils.php";
// require "victor.php";


$numero = $MINUMERO;
echo "El factorial de $numero es: " . 
                factorial($numero);

echo "Suma rara de 7: " . suma(7);
echo "Suma 7 + 77: " . suma(7,77);

echo "<br>";
echo $_SERVER["REMOTE_ADDR"];
var_dump($_SERVER);