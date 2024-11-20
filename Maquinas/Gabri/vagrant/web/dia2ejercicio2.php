<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla con datos de array</title>
</head>
<body>
    <form action="dia2ejercicio2b.php">
        <label for="cars">Choose a car:</label>
        <select name="cars[]" id="cars" multiple>
            <option value="volvo">Volvo</option>
            <option value="saab">Saab</option>
            <option value="mercedes">Mercedes</option>
            <option value="audi">Audi</option>
            <option value="renault">Renault</option>
            <option value="citroen">Citroen</option>
        </select>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>