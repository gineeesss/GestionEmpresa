<?php
session_start();

$NOMBREFICHERO = "palabras.txt";
$celda = NULL;
$celdacolor = NULL;
$celdavisible = NULL;

if (!isset($_SESSION["celda"]) || (isset($_GET["resetea"]))) {
    creaTablero();
} else {
    $celda = $_SESSION["celda"];
    $celdacolor = $_SESSION["celdacolor"];
    $celdavisible = $_SESSION["celdavisible"];
}

if (isset($_GET["fila"]) && isset($_GET["col"])) {
    $fila = $_GET["fila"];
    $col = $_GET["col"];
    darVuelta($fila, $col);
}


function creaTablero() {
    global $NOMBREFICHERO;
    global $celda;
    global $celdacolor;
    global $celdavisible;

// Abre el fichero y carga la lista de palabras
    $myfile = fopen($NOMBREFICHERO, "r") or die("Unable to open file!");
    while(!feof($myfile)) {
        $listaPalabras[] = trim(fgets($myfile));
      }
    fclose($myfile);
    $_SESSION["listaPalabras"] = $listaPalabras;
    
// Ordena aleatoriamente las palabras    
    shuffle($listaPalabras);
    
// Ordena aleatoriamente los colores
    $colores = ["blue","blue","blue","blue","blue","blue","blue",
                "red","red","red","red","red","red",
                "cyan",
                "white","white","white","white","white","white","white","white",
                "white","white","white"];  
    shuffle($colores);


    $contador=0;
    for ($fila=1; $fila<=5; $fila++){
        for ($col=1; $col<=5; $col++){
            $celda[$fila][$col] = $listaPalabras[$contador];
            $celdacolor[$fila][$col] = $colores[$contador];
            $celdavisible[$fila][$col] = False;
            $contador++;
        }
    }

    $_SESSION["celda"] = $celda;
    $_SESSION["celdacolor"] = $celdacolor;
    $_SESSION["celdavisible"] = $celdavisible;
}

function darVuelta($fila, $columna) {
    global $celdavisible;
    $celdavisible[$fila][$columna] = True;
    $_SESSION["celdavisible"] = $celdavisible;
}

// No se está usando por el momento
function resuelveTablero(){
    global $celda;
    global $celdacolor;

    echo "<table border=1>";
    for ($fila=1; $fila<=5; $fila++){
        echo "<tr>";
        for ($col=1; $col<=5; $col++){         
            echo "<td bgcolor='" . $celdacolor[$fila][$col] . "'>";
            echo "<b>";        
            echo "<a href='?fila=" . $fila . "col=" . $col . "'>"; 
            echo $celda[$fila][$col];
            echo "</a>";
            echo "</b>"; 
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

function dibujaTablero(){
    global $celda;
    global $celdacolor;
    global $celdavisible;

    echo "<table border=1>";
    for ($fila=1; $fila<=5; $fila++){
        echo "<tr>";
        for ($col=1; $col<=5; $col++){         
            if ($celdavisible[$fila][$col]) {
                echo "<td bgcolor='" . $celdacolor[$fila][$col] . "'>";
            } else {
                echo "<td bgcolor='orange'>";
            }
            echo "<b>";        
            echo "<a href='?fila=" . $fila . "&col=" . $col . "'>"; 
            echo $celda[$fila][$col];
            echo "</a>";
            echo "</b>"; 
            echo "</td>";
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
    <title>Document</title>
</head>
<body>
    <?php
        dibujaTablero();
    ?>
    <hr>
    <a href="?resetea=1">Resetear</a>
    <hr>
    <button><a href="subirarchivo.php">Subir fichero nuevo</a></button>
</body>
</html>