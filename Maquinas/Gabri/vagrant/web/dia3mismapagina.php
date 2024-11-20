<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario chufa</title>
</head>
<body>

<!-- Evalúa si el formulario ha sido enviado y si contiene un valor para el campo nombre -->
<?php
    if (isset($_GET["nombre"])) {
        $nombre = $_GET["nombre"];
        echo $nombre;
    } else {
?>
<!-- Si el formulario no ha sido enviado aún (no existe el parámetro nombre), entonces el código PHP muestra el formulario HTML que permite al usuario ingresar su nombre. -->
    <form action="" method="get">
        <input type="text" name="nombre" id="nombre">
        <input type="submit" value="Enviar">
    </form>

<?php
    }
?>
</body>
</html>