<?php
session_start();

$NOMBREFICHERO = "palabras.txt";
$celda = NULL;
$celdacolor = NULL;
$celdavisible = NULL;
creaTablero();

if (!isset($_SESSION["celda"]) || (isset($_GET["resetea"]))) {
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

    $filename = $_FILES['fileToUpload']['tmp_name'];

    $myfile = fopen($filename, "r") or die("Unable to open file!");
    $listaPalabras = [];
    while (!feof($myfile)) {
        $listaPalabras[] = trim(fgets($myfile));
    }
    fclose($myfile);
    $ficha = fopen($NOMBREFICHERO, "r") or die("Unable to open file!");
    while(!feof($ficha)) {
        $listaGorda[] = strtolower(trim(fgets($ficha)));
    }
    fclose($ficha);

    foreach($listaPalabras as $palabra){
        if (!in_array($palabra,$listaGorda)){
        $listaGorda[]=$palabra;
        $contador = $contador + 1;
        }
    }

// Ordena aleatoriamente las palabras    
    shuffle($listaGorda);
    
// Ordena aleatoriamente los colores
    $colores = ['white','white','white','white','white','white','white','white','white','white','white', 
    'danger','danger','danger','danger','danger','danger',
    'black',
    'success','success','success','success','success','success','success'];
    shuffle($colores);


    $contador=0;
    for ($fila=1; $fila<=5; $fila++){
        for ($col=1; $col<=5; $col++){
            $celda[$fila][$col] = $listaGorda[$contador];
            $celdacolor[$fila][$col] = $colores[$contador];
            $celdavisible[$fila][$col] = FALSE;
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

function resuelveTablero(){
    global $celda;
    global $celdacolor;

    echo "<table border=1>";
    for ($fila=1; $fila<=5; $fila++){
        echo "<tr>";
        for ($col=1; $col<=5; $col++){         
            echo "<td class='bg-" . $celdacolor[$fila][$col] . "'>";
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
                echo "<td class='bg-" . $celdacolor[$fila][$col] . "'>";
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
    <title>CodigoSecreto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <?php
        dibujaTablero();
    ?>
    <hr>
    <a href="?resetea=1">Resetear</a>
</body>
</html>