<?php
$variablecars = $_GET["cars"];
?>

<table border="1">
<tr>
    <th>Key</th>
    <th>Valor</th>
</tr>

<?php

$contador=0;

foreach ($variablecars as $key => $value) {

    // if ($contador % 2 == 0) {
    //     echo "<tr bgcolor='yellow'>";
    // }else {
    //     echo "<tr bgcolor='magenta'>";
    // }

switch ($contador % 4) {
    case 0:
        echo "<tr bgcolor='yellow'>";
        break;
    case 1:
        echo "<tr bgcolor='red'>";
        break;
    case 2:
        echo "<tr bgcolor='blue' color='white'>";
        break;
    case 3:
        echo "<tr bgcolor='cyan'>";
        break;
                            
}



    echo "<td>";
        echo $key;
    echo "</td>";

    echo "<td>";
    echo $value;
    echo "</td>";

    echo "</tr>";

    $contador++;
}
?>

</table>

<?php
// var_dump($_GET["cars"]);

// $marcas = ["volvo", "mercedes", "audi", "lexus", "toyota", "honda"];
// ?>
// <br>
// <?php

// echo $marcas[3];
// echo "<br>";
// echo $marcas[sizeof($marcas) - 1];
// echo "<br>";

// foreach ($marcas as $mimarca) {
//     echo $mimarca;
// }
