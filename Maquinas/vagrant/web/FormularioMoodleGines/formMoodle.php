<?php
$tratamiento = $_GET["tratamiento"];
$nombre = $_GET["nombre"];
$apellidos = $_GET["apellidos"];
$fecha = explode("-", $_GET["fecha"]);
$dia = $fecha[2];
$mes = $fecha[1];
$anio = $fecha[0];
switch ($tratamiento) {
    case 'Doctora':
    case 'Sra.':
        echo "La $tratamiento <strong>$nombre</strong> nació el $dia de <strong>$mes</strong> de $anio, tiene por tanto $edad años";
        break;
    case 'Homúnculo':
        echo "Le $tratamiento <strong>$nombre</strong> nació el $dia de <strong>$mes</strong> de $anio, tiene por tanto $edad años";
        break;
    default:
        echo "El $tratamiento <strong>$nombre</strong> nació el $dia de <strong>$mes</strong> de $anio, tiene por tanto $edad años";
        break;
}
?>
<html>
<p> <a href="formMoodle.html">Volver al formulario</a></p>
</html>