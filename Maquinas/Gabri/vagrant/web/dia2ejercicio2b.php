<?php
$variablecars = $_GET["cars"];
?>

<table border="1">
    <tr>
        <th>Key</th>
        <th>Value</th>
    </tr>

<?php
$contador = 0;
    
    foreach ($variablecars as $key => $value) {

        // // Alternar colores de las filas
        // if($contador % 2 == 0) {
        //     echo "<tr bgcolor='blue'>";
        // } else {
        //     echo "<tr bgcolor='magenta'>";
        // }

        // Alternar entre 4 colores
        switch($contador % 4) {
            case 0:
                echo "<tr bgcolor='blue'>";
                break;
            case 1:
                echo "<tr bgcolor='yellow'>";
                break;
            case 2:
                echo "<tr bgcolor='magenta'>";
                break;
            case 3:
                echo "<tr bgcolor='green'>";
                break;
        }

            echo "<td>" . $key . "</td>";
            echo "<td>" . $value . "</td>";
        echo "</tr>";
        $contador++;
    }
?>

</table>
<hr>

<?php
var_dump($variablecars);
?>