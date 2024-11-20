<?php
// SIN TERMINAR!!!
class Celda {
    public $palabra;
    public $color;
    public $visible;

    function __construct($palabra, $color) {
        $this->palabra = $palabra;
        $this->color = $color;
        $this->visible = false;  // Todas las celdas empiezan ocultas
    }

    public function darVuelta() {
        $this->visible = true;  // Dar la vuelta a la celda
    }
}

class Tablero {
    public $celdas = [];
    public $colores = ["cyan", "red", "lawngreen", "white"];
    
    function __construct($listaPalabras) {
        $this->crearTablero($listaPalabras);
    }

    function crearTablero($listaPalabras) {
        shuffle($listaPalabras);  // Mezclar palabras al azar
        $contador = 0;
        $contadorColores = ['cyan' => 0, 'red' => 0, 'lawngreen' => 0, 'white' => 0];

        for ($fila = 0; $fila < 5; $fila++) {
            for ($col = 0; $col < 5; $col++) {
                $palabra = $listaPalabras[$contador];
                $color = $this->asignarColor($contadorColores);
                $this->celdas[$fila][$col] = new Celda($palabra, $color);
                $contador++;
            }
        }
    }

    function asignarColor(&$contadorColores) {
        // Asignar un color basado en el conteo
        $color = $this->colores[array_rand($this->colores)];
        $contadorColores[$color]++;

        // Limitar el número de colores
        if ($color == "cyan" && $contadorColores[$color] == 8) {
            $this->eliminarColor($color);
        } elseif ($color == "red" && $contadorColores[$color] == 9) {
            $this->eliminarColor($color);
        } elseif ($color == "white" && $contadorColores[$color] == 7) {
            $this->eliminarColor($color);
        } elseif ($color == "lawngreen" && $contadorColores[$color] == 1) {
            $this->eliminarColor($color);
        }

        return $color;
    }

    private function eliminarColor($color) {
        // Eliminar color de la lista de selección
        $this->colores = array_filter($this->colores, function($c) use ($color) {
            return $c !== $color;
        });
    }

    public function darVueltaCelda($fila, $columna) {
        $this->celdas[$fila][$columna]->darVuelta();
    }
}

class Juego {
    public $tablero;
    public $listaPalabras;
    private $nombreFichero;

    public function __construct($nombreFichero = "palabras.txt") {
        $this->nombreFichero = $nombreFichero;
        $this->cargarPalabras();
        $this->tablero = new Tablero($this->listaPalabras);
    }

    private function cargarPalabras() {
        if (!isset($_SESSION["listaPalabras"]) || empty($_SESSION["listaPalabras"])) {
            $this->listaPalabras = file($this->nombreFichero, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $_SESSION["listaPalabras"] = $this->listaPalabras;
        } else {
            $this->listaPalabras = $_SESSION["listaPalabras"];
        }
    }

    public function resetearJuego() {
        $this->tablero = new Tablero($this->listaPalabras);
        $_SESSION["tablero"] = $this->tablero;
    }

    public function darVueltaCelda($fila, $columna) {
        $this->tablero->darVueltaCelda($fila, $columna);
        $_SESSION["tablero"] = $this->tablero;
    }
}

session_start();

if (!isset($_SESSION["juego"]) || isset($_GET["resetea"])) {
    // Iniciar un nuevo juego o resetear
    $juego = new Juego();
    $_SESSION["juego"] = $juego;
} else {
    // Recuperar el juego existente
    $juego = $_SESSION["juego"];
}

// Manejar la acción de darVuelta celdas
if (isset($_GET["fila"]) && isset($_GET["col"])) {
    $juego->darVueltaCelda($_GET["fila"], $_GET["col"]);
    $_SESSION["juego"] = $juego;
}

// Dibujar tablero
function dibujaTablero($tablero) {
    echo "<table border=1>";
    for ($fila = 0; $fila < 5; $fila++) {
        echo "<tr>";
        for ($col = 0; $col < 5; $col++) {
            $celda = $tablero->celdas[$fila][$col];
            $bgColor = $celda->visible ? $celda->color : 'lightgray';
            echo "<td bgcolor='$bgColor'>";
            echo "<a href='?fila=$fila&col=$col'>" . ($celda->visible ? $celda->palabra : "???") . "</a>";
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

// Mostrar tablero
dibujaTablero($juego->tablero);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Código secreto 2.0</title>
</head>
<body>
    <hr>
    <button><a href="?resetea=1">Resetear</a></button>
    <hr>
    <form action="subir.php" method="post" enctype="multipart/form-data">
        Selecciona un archivo para subir:
        <input type="file" name="fichero" id="fichero">
        <input type="submit" value="Subir fichero" name="submit">
    </form>
</body>
</html>


