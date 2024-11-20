<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
// Dolarín para variables
$variable1 = 10;
$variable2 = 120;
$variable3 = 4.5;
$variabletexto = "Hola qué tal";
// Puntito para concatenar
echo "<p>".$variabletexto ."</p><p>".$variable3."</p>";
?>

<p style="color:red">Holita</p>

<?php
echo "<p>".$variabletexto ."</p><p>".$variable3."</p>";
// Sin concatenar, todo entrecomillado
echo "<p>$variabletexto</p><p>$variable2</p>";
echo 5 * 2;
?>

</body>
</html>
