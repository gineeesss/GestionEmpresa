<?php


class Celda {
  public $tienemina;
  public $nminasalrededor;
  public $visible;

  function __construct($tienemina, $nminasalrededor, $visible) {
    $this->tienemina = $tienemina;
    $this->nminasalrededor = $nminasalrededor;
    $this->visible = $visible;
  }

}

class Tablero {
    public $nfilas;
    public $ncols;
    public $nminas;
    public $celdas;
    public $terminadoPIERDES;
    public $terminadoGANAS;

    function __construct($nfilas, $ncols, $nminas) {
        $this->terminadoPIERDES = FALSE;
        $this->terminadoGANAS = FALSE;
        $this->nfilas = $nfilas;
        $this->ncols = $ncols;
        $this->nminas = $nminas;

        $numeroceldas = $this->nfilas * $this->ncols;
        $matrizceldas = NULL;
        for($i=0; $i < $numeroceldas; $i++){
            if ($i < $this->nminas) {
                $matrizceldas[] = TRUE;
            } else {
                $matrizceldas[] = FALSE;
            }
        }
        shuffle($matrizceldas);

        $contador = 0;
        for ($i = 1; $i <= $this->nfilas; $i++) {
            for ($j = 1; $j <= $this->ncols; $j++) {
                $this->celdas[$i][$j] = new Celda($matrizceldas[$contador],0,FALSE);
                $contador++;
            }
        }
        $this->contarMinasAlrededor();
    }

    function contarMinasAlrededor() {
        $filas = $this->nfilas;
        $columnas = $this->ncols;
        
        // Crear una matriz vacía para almacenar el conteo de minas
        $resultado = array();
    
        for ($i = 1; $i <= $filas; $i++) {
            for ($j = 1; $j <= $columnas; $j++) {
                $minasAlrededor = 0;
    
                // Recorrer las celdas vecinas (incluyendo diagonales)
                for ($x = -1; $x <= 1; $x++) {
                    for ($y = -1; $y <= 1; $y++) {
                        // Evitar contar la celda actual
                        if ($x == 0 && $y == 0) {
                            continue;
                        }
    
                        // Coordenadas de la celda vecina
                        $vecinoX = $i + $x;
                        $vecinoY = $j + $y;
    
                        // Verificar que la celda vecina esté dentro del tablero
                        if ($vecinoX >= 1 && $vecinoX <= $filas && $vecinoY >= 1 && $vecinoY <= $columnas) {
                            // Sumar si hay una mina en la celda vecina
                            if ($this->celdas[$vecinoX][$vecinoY]->tienemina) {
                                $minasAlrededor++;
                            }
                        }
                    }
                }
    
                // Guardar el conteo en la matriz resultado
                $this->celdas[$i][$j]->nminasalrededor = $minasAlrededor;
            }
        }
    
    }

    function click($fila, $col) {
        if ($this->celdas[$fila][$col]->visible == TRUE) {return;} 
        $this->celdas[$fila][$col]->visible = TRUE;
        if ($this->celdas[$fila][$col]->tienemina) {$this->descubrirMinas();}
        if ( ($this->celdas[$fila][$col]->nminasalrededor == 0) && ($this->celdas[$fila][$col]->tienemina != TRUE) ) {
                // Recorrer las celdas vecinas (incluyendo diagonales)
                for ($x = -1; $x <= 1; $x++) {
                    for ($y = -1; $y <= 1; $y++) {
                        // Evitar contar la celda actual
                        if ($x == 0 && $y == 0) {
                            continue;
                        }   
                        // Coordenadas de la celda vecina
                        $vecinoX = $fila + $x;
                        $vecinoY = $col + $y;
                        // Verificar que la celda vecina esté dentro del tablero
                        if ($vecinoX >= 1 && $vecinoX <= $this->nfilas && $vecinoY >= 1 && $vecinoY <= $this->ncols) {
                            if ($this->celdas[$vecinoX][$vecinoY]->nminasalrededor == 0) {
                                $this->click($vecinoX, $vecinoY);
                            }

                        }
                    }
                }


        }
    }

    function dibujar(){    
        echo "<table border=1>";
        for ($fila=1; $fila<=$this->nfilas; $fila++){
            echo "<tr>";
            for ($col=1; $col<=$this->ncols; $col++){         
                if ($this->celdas[$fila][$col]->visible) {       
                    if($this->celdas[$fila][$col]->tienemina){
                        echo "<td bgcolor='red'>";
                        echo "<b>"; 
                        echo "*";
                        echo "</b>"; 
                        echo "</td>";
                    } else {
                        echo "<td bgcolor='gray'>";
                        echo "<b>";
                        if ($this->celdas[$fila][$col]->nminasalrededor == 0) {
                            echo "&nbsp;&nbsp;";
                        } else {
                            echo $this->celdas[$fila][$col]->nminasalrededor;   
                        }
                        echo "</b>"; 
                        echo "</td>";
                    }


                } else {
                    echo "<td bgcolor='white'>";
                    echo "<b>";        
                    echo "<a href='?fila=" . $fila . "&col=" . $col . "'>"; 
                    echo "?";
                    echo "</a>";
                    echo "</b>"; 
                    echo "</td>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
    
    }

    function dibujar2(){    
        echo "<table border=1>";
        for ($fila=1; $fila<=$this->nfilas; $fila++){
            echo "<tr>";
            for ($col=1; $col<=$this->ncols; $col++){         
                if ($this->celdas[$fila][$col]->visible) {
                    echo "<td bgcolor='gray'>";
                } else {
                    echo "<td bgcolor='white'>";
                }
                echo "<b>";        
                echo "<a href='?fila=" . $fila . "&col=" . $col . "'>"; 
                if($this->celdas[$fila][$col]->tienemina){
                     echo "*";
                    } else {
                     echo $this->celdas[$fila][$col]->nminasalrededor;   
                    }
                echo "</a>";
                echo "</b>"; 
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    
    }

    function descubrirMinas() {
        $this->terminadoPIERDES = TRUE;
        for ($fila=1; $fila<=$this->nfilas; $fila++){
            for ($col=1; $col<=$this->ncols; $col++){

                $this->celdas[$fila][$col]->visible = TRUE;


                if ($this->celdas[$fila][$col]->tienemina) {
                    $this->celdas[$fila][$col]->visible = TRUE;
                }   
            }
        }
    }

    function quedaAgua() {
        for ($i=1; $i<=$this->nfilas; $i++) {
            for ($j=1; $j<=$this->ncols; $j++) {
                if (!($this->celdas[$i][$j]->visible) && !($this->celdas[$i][$j]->tienemina)) {
                    return TRUE;
                }
            }
        }
        return FALSE;
    }

}

session_start();
if (isset($_GET["fila"]) && isset($_GET["col"])) {
    $mitablero = $_SESSION["mitablero"];
    $fila = $_GET["fila"];
    $col = $_GET["col"];
    $mitablero->click($fila, $col);
} else {
    session_unset(); 
    session_destroy();
    session_start();
    $mitablero = new Tablero(8,15,10);
//    $mitablero = new Tablero(5,5,1);
    $_SESSION["mitablero"] = $mitablero;
}

$mitablero->dibujar();
?>
<hr>
<a href="?resetear=true">Reiniciar el tablero</a>&nbsp;&nbsp;&nbsp;&nbsp;

<?php
if ($mitablero->terminadoPIERDES) {
    echo "<span style='color:red'>Has perdido</span>";
} else {
    if (!$mitablero->quedaAgua()) {
        echo "<span style='color:green'>Has GANADO</span>";
    }
}