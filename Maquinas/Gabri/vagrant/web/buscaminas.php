<?php
    $celdas = [];

    function crearTablero() {
        global $celdas;

        // Rellenamos una matriz con números del 1 al 30 (6 filas * 5 columnas)
        for($i = 1; $i <= 30 ; $i++) {
            $matriz[] = $i;
        }

        // Desordenamos los elementos de la matriz aleatoriamente
        shuffle($matriz);
        $contador = 0;

        // Distribuimos los números entre las celdas. Las celdas que tengan números del 1 al 5 serán las que tengan minas
        for($fila = 0; $fila < 5; $fila++) {
            for($columna = 0; $columna < 6; $columna++) {
                $celdas[$fila][$columna] = $matriz[$contador];
                $contador++;
                if ($celdas[$fila][$columna] <= 5) {
                    $celdas[$fila][$columna] = "*";
                } 
            }
        }

        // Volvemos a recorrer las celdas
        for($fila = 0; $fila < 5; $fila++) {
            for($columna = 0; $columna < 6; $columna++) {
                // Si la celda no contiene mina
                if ($celdas[$fila][$columna] != "*") { 
                    // Ponemos el contador de minas cercanas a esa celda a 0 
                    $minaCerca = 0;
                    // Comprobamos las celdas adyacentes a esa celda y sumamos al contador de minas por cada mina que encontremos.
                    // El recorrido empieza en la fila de la celda -1 y termina en la fila de la celda +1. Lo mismo con las columnas.
                    // El contador de filas y columnas no puede ser menor a 0 ni mayor a 4 (filas) y 5 (columnas). De este modo, se soluciona el problema de las celdas de los bordes
                    for ($i = max(0, $fila - 1); $i <= min(4, $fila + 1); $i++) {
                        for($j = max(0, $columna - 1); $j <= min(5, $columna + 1); $j++) {
                            if ($celdas[$i][$j] == "*") {
                                $minaCerca++;
                            }
                        }
                    }
                    // Asignamos a la celda las minas que se han contado a su alrededor
                    $celdas[$fila][$columna] = $minaCerca;  
                }
            }
        }
    }

    function dibujarTablero() {
        global $celdas;
        
        echo "<table border=1>";

        for($fila = 0; $fila < 5; $fila++) {
            echo "<tr>";
            for($columna = 0; $columna < 6; $columna++) {
                echo "<td>" . $celdas[$fila][$columna] . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscaminas</title>
<!-- Un poco de CSS dentro del <head> -->
    <style>
                table {
                    margin: 20px;
                }
                td {
                    width: 50px;
                    height: 50px;
                    text-align: center;
                    vertical-align: middle;
                    border: 1px solid black;
                    background-color: lightgray;
                    font-size: 20px;
                }
    </style>
</head>
<body>
    <?php
        crearTablero();
        dibujarTablero();
    ?>
</body>
</html>