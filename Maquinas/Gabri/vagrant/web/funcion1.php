<?php
// Importamos un fichero (no hay que poner la ruta porque está en la misma carpeta)
// Con once solo se incluye una vez (no pasa nada si accidentalmente importamos más veces)
include_once "utils.php";
include_once "utils.php";
// include VS require --> include lo intenta importar (si no está, arroja un warning y tira). Con require, arroja un fatal error si no lo encuentra (no sigue adelante)
// require "victor.php";

$numero = $MINUMERO;
echo "El factorial de $numero es " . factorial($numero);
// Pasando un solo operando, el segundo por defecto es 99
echo "<br>Suma rara de 7: " . suma(7);
echo "<br>Suma de 7 + 77: " . suma(7, 77);
echo "<br>";
// Variable REMOTE_ADDR obtenida de info.php. Realmente $_SERVER es un array, y estoy consultando ese índice
echo $_SERVER["REMOTE_ADDR"];




