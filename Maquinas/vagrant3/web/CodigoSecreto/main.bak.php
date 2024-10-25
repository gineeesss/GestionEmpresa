<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Código Secreto</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
$ficheroPalabras = fopen("palabras.txt", "r") or die("Imposible abrir");
//echo fread($ficheroPalabras,filesize("palabras.txt"));

/*$array = explode("\n",$ficheroPalabras);
foreach($array as $palabra => $valor){
    $valor = trim($palabra);    
}
*/
while(!feof($ficheroPalabras)){
    $array[] = trim(fgets($ficheroPalabras));
}


$tablero = [];
for ($w = 0; $w<5; $w++){
    for ($t = 0; $t<5; $t++){
        $tablero[$w][$t] =  $array[rand(0,401)];
    }
}




$colores = ['white', 'danger', 'black','primary'];
$danger = 7;
$primary = 6;
$black = 1;
$white = 11;

$colores = ['white','white','white','white','white','white','white','white','white','white','white', 
            'danger','danger','danger','danger','danger','danger',
            'black',
            'primary','primary','primary','primary','primary','primary','primary']

//echo "<form action=# method=get>"
echo "<table class='table table-bordered'>"; 
//while(($danger+$primary+$black+$white)>0){
    for ($w = 0; $w<5; $w++){
        echo "<tr>";
        for ($t = 0; $t<5; $t++){
                echo "<td style='width: 10px; height: 50px;'> <a href=' ?' style= 'text-decoration: none;' >"  . $tablero[$w][$t]  . "</a> </td>";                
                $$color--;
                if($$color<=0){
                    unset($colores[array_search($color,$colores)]);
                }    
            } 
    }    
echo "</tr>";
echo "</table>";

echo "<br><br>";
echo "<br><br>";
fclose($ficheroPalabras);
//var_dump($array);
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php







/*FUNCIONA (solo pinta la tabla como se quiere)

$colores = ['white', 'danger', 'black','primary'];
$danger = 7;
$primary = 6;
$black = 1;
$white = 11;


echo "<table class='table table-bordered'>"; 
//while(($danger+$primary+$black+$white)>0){
    for ($w = 0; $w<5; $w++){
        echo "<tr>";
        for ($t = 0; $t<5; $t++){
                //$color = $colores[rand(0,(count($colores) - 1))];
                $color = $colores[array_rand($colores)];
                echo "<td class='bg-$color' style='width: 10px; height: 50px;'>" . $tablero[$w][$t]  . "</td>";                
                $$color--;
                if($$color<=0){
                    unset($colores[array_search($color,$colores)]);
                }    
            } 
    }    
echo "</tr>";
//}
echo "</table>";
echo "<br><br>";
echo "<br><br>";
fclose($ficheroPalabras);
//var_dump($array);
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php

*/




/*$colores = ['blue', 'red', 'white','green'];
$red = 0;
$blue = 0;
$green = 0;



echo "<table class='table-active table-borderer'>";
echo "<table class='table table-bordered'>"; 
for ($w = 0; $w<5; $w++){
        echo "<tr>";
        for ($t = 0; $t<5; $t++){
            $color = $colores[rand(0,3)];
            echo "<td bgcolor = " . $color . ">" . $tablero[$w][$t]  . "</td>";                
            $$color++;
        }
        echo "</tr>";
}
echo "</table>";
echo $red ;
echo "<br><br>";
echo $blue ;
echo "<br><br>";
echo $green ;
fclose($ficheroPalabras);
//var_dump($array);
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
*/



