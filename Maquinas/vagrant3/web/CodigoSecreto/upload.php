<?php
$NOMBREFICHERO = "palabras.txt";
$filename = $_FILES['fileToUpload']['tmp_name'];
$contador = 0;

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
    echo $palabra;
    if (!in_array($palabra,$listaGorda)){
      $listaGorda[]=$palabra;
      $contador = $contador + 1;
    }
    echo "<br>";
}




echo $contador;
var_dump($listaGorda);

