<?php
$myfile = fopen("palabras.txt", "r") or die("¡No se puede abrir el fichero!");
// $lista = fread($myfile, filesize("palabras.txt"));
// fclose($myfile);
// var_dump($lista);
// $matriz = explode("\n", $lista);
// echo "<br>";

// foreach($matriz as $key => $value) {
//     $matriz[$key] = trim($value);
// }

while(!feof($myfile)) {
    $matriz[] = trim(fgets($myfile));
  }
fclose($myfile);
// Haciendo shuffle al principio, desordeno el array original randomly. Luego en el bucle me quedaré con las 25 primeras posiciones.
shuffle($matriz);

$contador = 0;

$colores = ["#33caff", "#ff4747", "#a8a8a8", "white"];
$contadorRojo = 0;
$contadorAzul = 0;
$contadorBlanco = 0;
$contadorGris = 0;

?>

<table border="1">

<?php
// 5 * 5 = 25 posiciones
for ($i=0; $i < 5; $i++) {
    echo "<tr>";
        for ($j=0; $j < 5; $j++) {
        $celda[$i][$j] = $matriz[$contador];
        $fondo = $colores[array_rand($colores)];
        switch($fondo) {
            case "#33caff":
                $contadorAzul++;
                if($contadorAzul == 8) {
                    unset($colores[array_search("#33caff", $colores)]);
                }
                break;
            case "#ff4747":
                $contadorRojo++;
                if($contadorRojo == 9) {
                    unset($colores[array_search("#ff4747", $colores)]);
                }
                break;
            case "white":
                $contadorBlanco++;
                if($contadorBlanco == 7) {
                    unset($colores[array_search("white", $colores)]);
                }
                break;
            case "#a8a8a8":
                $contadorGris++;
                if($contadorGris == 1) {
                    unset($colores[array_search("#a8a8a8", $colores)]);
                }
                break;
        }
        echo "<td bgcolor= '" . $fondo . "'>" . "<a href=?'fila=" . $i . "col=" . $j . "'>" . $celda[$i][$j] . "</a> </td>";
        $contador++;
    }
    echo "</tr>";
}
?>

</table>