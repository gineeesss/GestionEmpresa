<?php

$tratamiento = $_REQUEST["tratamiento"];
$nombre = $_REQUEST["nombre"];
$apellidos = $_REQUEST["apellidos"];
$fechaNacimiento = date_create($_REQUEST["fecha_nacimiento"]);
date_default_timezone_set('Europe/Madrid');
$fechaActual = date_create(date("Y-m-d"));
$edad = date_diff($fechaNacimiento, $fechaActual)->format('%y');

// Lo suyo habría sido hacerlo con setlocale() y strftime(), pero no funcionaba ¯\_(ツ)_/¯
$mesesEspanol = [
    'January' => 'enero',
    'February' => 'febrero',
    'March' => 'marzo',
    'April' => 'abril',
    'May' => 'mayo',
    'June' => 'junio',
    'July' => 'julio',
    'August' => 'agosto',
    'September' => 'septiembre',
    'October' => 'octubre',
    'November' => 'noviembre',
    'December' => 'diciembre'
];

// Formateamos la fecha de nacimiento y sustituimos las claves del array asociativo por sus valores correspondientes (para traducir los meses a español) 
$fechaNacimientoFormateada = str_replace(array_keys($mesesEspanol), $mesesEspanol, date_format($fechaNacimiento, 'j \d\e F \d\e Y'));

switch($tratamiento) {
    case "señor":
    case "goblin":
    case "ser del averno":
        echo "El ";
        break;
    default:
        echo "La ";
}

echo "$tratamiento $nombre $apellidos nació el $fechaNacimientoFormateada, tiene por tanto $edad años <br><br>";
echo "<a href=\"formularios101.html\"><button>Atrás</button></a>";

?>