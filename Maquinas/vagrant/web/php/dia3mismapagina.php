<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
<?php	
    if(isset($_GET["nombre"])){
        $nombte = $_GET["nombre"];
        echo $nombte;
    }else {
?>

        <form action="" method="get">
            <input type="text" name="nombre">
            <input type="submit" name="Enviar">
    </form>

<?php
}
?>
</body>
</html>