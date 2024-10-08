<?php
function factorial($numero) : Int {
    if ($contador!= 0 ){
        return $numero * factorial($numero - 1);
    } 
        return 1;
}
function suma($sum1, $sum2=99){
    return $sum1 + $sum2;
}