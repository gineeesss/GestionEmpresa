<?php
$variable = ($_GET["cars"]);

?>
<table border="1" class="table-hover">
    <tr>
        <th>Counter</th>
        <th>Marca</th>
    </tr>
<?php
$contador = 0;
foreach ($variable as $key => $value) {
    //if ($contador % 2 == 0){
    //    echo "<tr bgcolor='yellow'>";
    //}else {
    //    echo "<tr bgcolor='magenta'>";
    //
    //}
    switch($contador % 3){
        case 1:
            echo "<tr bgcolor='yellow'>";
            break;
        case 2:
            echo "<tr bgcolor='red'>";
            break;
        default:
            echo "<tr bgcolor='green'>";
        break;
    }
    //echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
    //echo "</tr>";
    $contador++;
}
?>
</table>

