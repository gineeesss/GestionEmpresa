<?php
$bombo = array();
$nuevo;
while(count($bombo) < 100){
    $nuevo = rand(0,99);
    if (!in_array($nuevo, $bombo)){
        $bombo[] = $nuevo;
    }
}
echo count($bombo);
$index = 0;
echo "<table border=1>";
for ($w = 0; $w<10; $w++){
    echo "<tr>";
    for ($t = 0; $t<10; $t++){
        if ($bombo[$index] == null ){ // considera 0 como null 
            echo "<td>" . 0 ."</td>"; 
        } else {
            echo "<td>" . $bombo[$index]  . "</td>";                
        }
        $index++;
    }
    echo "</tr>";
}
echo "</table>";

?>

<!--
for ($i=1; $i < 99; $i++) { 
    $bingoInicial[] = $i;
}
for ($i=1 $i < ; $i++) { 
    $indice = random_int(0,sizeof($bingoInicial)-1);
}
echo ;
echo "<br>";
foreach ($bombo as $i){
    echo $i . " - ";                
}
-->