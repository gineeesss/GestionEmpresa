<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
<?php
    if (isset($_GET["nombre"])) {
        $nombre = $_GET["nombre"];
        echo $nombre;
    } else {
?>
        <form action="" method="get">
            <input type="text" name="nombre" id="">
            <input type="submit" value="Enviar">
        </form>
<?php
}
?>
    </body>
    </html>
