<?php
session_start();
// var_dump($_FILES);
$NOMBREFICHERO = "palabras.txt";
?>

<h3>Leo el fichero</h3>

<?php
// Cargo la matriz de nuevas palabras
$myfile = fopen($_FILES["fichero"]["tmp_name"], "r") or die("Unable to open file!");
while(!feof($myfile)) {
    $nuevasPalabras[] = strtolower(trim(fgets($myfile)));
  }
fclose($myfile);

// // Cargo la matriz antigua
// $myfile = fopen($NOMBREFICHERO, "r") or die("Unable to open file!");
//     while(!feof($myfile)) {
//         $listaPalabras[] = trim(fgets($myfile));
//       }
// fclose($myfile);

// Contador de palabras añadidas
$contador = 0;

foreach($nuevasPalabras as $elemento) {
    // Si no se encuentra el elemento en la lista de palabras original, se añade
    if(!in_array($elemento, $_SESSION["listaPalabras"])) {
        $_SESSION["listaPalabras"][] = $elemento;
        echo $elemento . " añadido"; 
        echo "<br>";
        // Se incrementa el contador de palabras añadidas
        $contador++;
    }
}

// Ordenar alfabéticamente el array antes de escribir el array en el fichero
sort($_SESSION["listaPalabras"]);

// Abrimos el fichero original y escribimos la matriz entera (nos estamos cargando el contenido original del archivo). Para hacer append, sería en modo "a" en vez de "w"
$myfile = fopen($NOMBREFICHERO, "w") or die("Unable to open file!");
foreach($_SESSION["listaPalabras"] as $elemento) {
    fwrite($myfile, $elemento);
    // Importante meter el salto de línea
    fwrite($myfile, "\n");
}
// Cerrar el fichero
fclose($myfile);

echo "<br>Palabras añadidas: " . $contador;

// Posibles mejoras: meter código redundante en funciones, quizás guardar el array original en una variable de sesión