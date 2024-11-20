
<?php
// Paso por referencia: la modificación que sucede en la función permanece fuera de ella
function add_some_extra(&$string)
{
    $string .= 'y algo más.';
}

$str = 'Esto es una cadena, ';
add_some_extra($str);
echo $str;    // outputs 'Esto es una cadena, y algo más.'
?>
