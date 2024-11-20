<?php
// Este archivo contiene lo mismo que lo de Ángel, pero con mi implementación de los colores y manejando todo desde este mismo archivo. Además, evita la inserción de una línea en blanco al inicio de palabras.txt cada vez que volvemos a comparar los dos ficheros

session_start(); // La sesión guarda en el servidor unas variables hasta que se cierre

$NOMBRE_FICHERO = "palabras.txt";
$celda = NULL;
$celdacolor = NULL;
$celdavisible = NULL;

// Si no está asignada la variable de sesión celda o si se ha obtenido el valor de resetea
if (!isset($_SESSION["celda"]) || (isset($_GET["resetea"]))) {
    creaTablero();
} else {
    $celda = $_SESSION["celda"];
    $celdacolor = $_SESSION["celdacolor"];
    $celdavisible = $_SESSION["celdavisible"];
}

// Si se han pasado valores para fila y columna, se guardan en variables y se pasan a la función darVuelta
if (isset($_GET["fila"]) && isset($_GET["col"])) {
    $fila = $_GET["fila"];
    $col = $_GET["col"];
    darVuelta($fila, $col);
}

function creaTablero() {
    // Con global usamos una variable que está definida fuera de la función, en el ámbito global (parecido a pasarlas por parámetro, aunque no igual)
    global $NOMBRE_FICHERO; 
    global $celda;
    global $celdacolor;
    global $celdavisible;
    
    // Verificar si la lista de palabras en la sesión está vacía o no existe
    if (!isset($_SESSION["listaPalabras"]) || empty($_SESSION["listaPalabras"])) {
        // Abre el fichero y carga la lista de palabras
        $myfile = fopen($NOMBRE_FICHERO, "r") or die("¡No se puede abrir el fichero!");

        $listaPalabras = [];

        while (!feof($myfile)) {
            $palabra = trim(fgets($myfile));
            if ($palabra !== "") {
                $listaPalabras[] = $palabra;
            }
        }
        fclose($myfile);
        
        // Guardar las palabras en la sesión para futuras solicitudes
        $_SESSION["listaPalabras"] = $listaPalabras;
    } else {
        // Si la sesión ya tiene palabras, usarlas
        $listaPalabras = $_SESSION["listaPalabras"];
    }

    // Haciendo shuffle al principio, desordeno el array original randomly. Luego en el bucle me quedaré con las 25 primeras posiciones.
    shuffle($listaPalabras);

    $contador = 0; // Contador con el que recorreremos el array de palabras desordenadas aleatoriamente

    $colores = ["cyan", "red", "lawngreen", "white"];
    $contadorRojo = 0;
    $contadorAzul = 0;
    $contadorBlanco = 0;
    $contadorAsesino = 0;

    // Se asigna a cada celda una palabra, un color y se inicializa su estado visible a false
    for ($fila=0; $fila < 5; $fila++) {
        for ($col=0; $col < 5; $col++) {
            $celda[$fila][$col] = $listaPalabras[$contador];
            $fondo = $colores[array_rand($colores)];
            $celdacolor[$fila][$col] = $fondo;
            $celdavisible[$fila][$col] = False;
            switch($fondo) {
                case "cyan":
                    $contadorAzul++;
                    if($contadorAzul == 8) {
                        unset($colores[array_search("cyan", $colores)]);
                    }
                    break;
                case "red":
                    $contadorRojo++;
                    if($contadorRojo == 9) {
                        unset($colores[array_search("red", $colores)]);
                    }
                    break;
                case "white":
                    $contadorBlanco++;
                    if($contadorBlanco == 7) {
                        unset($colores[array_search("white", $colores)]);
                    }
                    break;
                case "lawngreen":
                    $contadorAsesino++;
                    if($contadorAsesino == 1) {
                        unset($colores[array_search("lawngreen", $colores)]);
                    }
                    break;
            }
            $contador++;
        }
    }

    // Al final de la creación de la tabla, se guardan en las diferentes variables de sesión los tres arrays de dos dimensiones:
        // Las 25 palabras
        // Los colores para las 25 celdas
        // El estado de las celdas (false, por el momento)
    $_SESSION["celda"] = $celda;
    $_SESSION["celdacolor"] = $celdacolor;
    $_SESSION["celdavisible"] = $celdavisible;

}

function darVuelta($fila, $columna) {
    global $celdavisible;
    $celdavisible[$fila][$columna] = True;
    $_SESSION["celdavisible"] = $celdavisible; // Cuando se le da la vuelta a una tarjeta, se modifica en el array y se memoriza de nuevo en la variable de sesión
}

function dibujaTablero() {
    global $celda;
    global $celdacolor;
    global $celdavisible;

    echo "<table border=1>";
    // 5 * 5 = 25 posiciones
    for ($fila=0; $fila < 5; $fila++) {
        echo "<tr>";
            for ($col=0; $col < 5; $col++) {
                if ($celdavisible[$fila][$col]) { // Si está dada la vuelta
                    echo "<td bgcolor='" . $celdacolor[$fila][$col] . "'>";
                } else { // Si no está dada la vuelta
                    echo "<td bgcolor='lightgray'>";
                }
                echo "<a href='?fila=" . $fila . "&col=" . $col . "'>"; // Pasa las variables $fila y $col con sus respectivos valores a través de la URL, como parámetros GET
                echo $celda[$fila][$col];
                echo "</a>";
                echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

// Si se ha subido un archivo, se actualiza el fichero de palabras
if (isset($_FILES['fichero'])) {

    // Lee el archivo subido
    $myfile = fopen($_FILES["fichero"]["tmp_name"], "r") or die("¡No se puede abrir el fichero!");
    while (!feof($myfile)) {
        $nuevasPalabras[] = strtolower(trim(fgets($myfile)));
    }
    fclose($myfile);

    // Añade las palabras nuevas si no están en la lista original
    $contador = 0;

    foreach ($nuevasPalabras as $elemento) {
        if (!in_array($elemento, $_SESSION["listaPalabras"])) {
            $_SESSION["listaPalabras"][] = $elemento;
            echo $elemento . " añadido<br>";
            $contador++;
        }
    }

    if ($contador > 0) {
        // Ordena alfabéticamente
        sort($_SESSION["listaPalabras"]);

        // Guarda la lista actualizada en el archivo
        $myfile = fopen($NOMBRE_FICHERO, "w") or die("¡No se puede abrir el fichero!");
        foreach ($_SESSION["listaPalabras"] as $elemento) {
            fwrite($myfile, $elemento . "\n");
        }
        fclose($myfile);

        echo "<br>Palabras añadidas: " . $contador;

        // Recargar el tablero con las nuevas palabras
        creaTablero();
    } else {
        echo "<br>No se añadieron nuevas palabras.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Código secreto 2.0</title>
</head>
<body>
    <?php
        dibujaTablero();
    ?>
    <hr>
    <button><a href="?resetea=1">Resetear</a></button> <!-- Pasa la variable resetea con valor 1 por la URL (el valor 1 es por ponerle alguno) -->
    <hr>
    <form action="codigosecreto3.php" method="post" enctype="multipart/form-data">
        Selecciona un archivo para subir:
        <input type="file" name="fichero" id="fichero">
        <input type="submit" value="Subir fichero" name="submit">
    </form>
</body>
</html>