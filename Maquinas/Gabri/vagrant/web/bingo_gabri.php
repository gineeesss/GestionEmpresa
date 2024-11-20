<?php
for ($i = 0; $i < 20; $i++) {
    $bola[$i] = $i+1;
    echo $bola[$i]." ";
}

$matrizInicial=count($bola);
echo "<br>";

for($i=0; $i<$matrizInicial; $i++){
   $indiceBola=rand(0,count($bola)-1);
   echo $bola[$indiceBola]." ";
   if($bola[$indiceBola]!=$bola[count($bola)-1]){
    $bola[$indiceBola]=array_pop($bola);
   }else{
    array_pop($bola);
   }
}


