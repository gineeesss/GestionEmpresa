<!DOCTYPE html>
<html lang=es>
    <head>
        <title> Ejercicio 1</title>
    </head>
    <body>
        <?php
        $variable1 = 10;
        $variable2 = 120;
        $variable3 = 4.5;
        $variabletexto = 'hola';
        echo $variable1;
        echo "\n";
        echo $variabletexto;
        echo "<br>hasdsaola</br>";
        echo "<br>hasdsaola</br>";
        
        ?>
        <?php
        if($variable1 > $variable2){
            echo "Es mayor";
        }else {
            echo $variable1 . " no es mayor que " . $variable2;
        }
        for ($i=0; $i < 11; $i++) { 
            echo "Iteración $i";
            echo "<br></br>";
            echo "<hr>";
        }
            ?>
    </body>
</html>