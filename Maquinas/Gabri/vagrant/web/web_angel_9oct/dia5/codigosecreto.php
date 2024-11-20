<?php
$myfile = fopen("palabras.txt", "r") or die("Unable to open file!");
// $lista = fread($myfile,filesize("palabras.txt"));
// fclose($myfile);

// var_dump($lista);
// $matriz = explode("\n", $lista);
// echo "<br>";

// foreach ($matriz as $key => $value) {
//     $matriz[$key] = trim($value);
// }

while(!feof($myfile)) {
    $matriz[] = trim(fgets($myfile));
  }
fclose($myfile);

// var_dump($matriz);

shuffle($matriz);

$contador=0;

$colores = ["blue","blue","blue","blue","blue","blue","blue",
            "red","red","red","red","red","red","cyan",
            "white","white","white","white","white","white","white","white",
            "white","white","white"];
shuffle($colores);

?>
<table border=1>
<?php
for ($fila=1; $fila<=5; $fila++){
    echo "<tr>";
    for ($col=1; $col<=5; $col++){
        $celda[$fila][$col] = $matriz[$contador];
        echo "<td bgcolor='" . $colores[$contador] . "'>";
        echo "<b>" . $celda[$fila][$col]. "</b>";
        $celdacolor[$fila][$col] = $colores[$contador];
        echo "</td>";
        $contador++;
    }
    echo "</tr>";
}
?>
</table>