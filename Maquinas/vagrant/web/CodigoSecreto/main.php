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

$colores = ['blue', 'red', 'white','green'];
$red = 0;
$blue = 0;
$green = 0;



echo "<table border=1>";
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