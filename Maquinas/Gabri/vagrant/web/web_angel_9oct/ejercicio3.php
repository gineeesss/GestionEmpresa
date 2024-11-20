<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="ejercicio3b.php" method="get">
        <input type="text" name="ope1" id="operando1">
        <select name="operacion">
            <option value="sumar">+</option>
            <option value="restar">-</option>
            <option value="multiplicar">x</option>
            <option value="dividir">/</option>
        </select>

        <input type="text" name="ope2" id="operando2">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>