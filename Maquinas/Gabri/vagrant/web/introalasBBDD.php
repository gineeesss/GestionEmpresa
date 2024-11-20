<?php
$servername = "127.0.0.1";
$username = "root";
$password = "toor";
$basedatos = "prueba1";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$basedatos", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

/* try {
  $sql = "INSERT INTO telefonos (nombre, apellidos, telefono)
  VALUES ('John', 'Doe', '554253')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
} */

try {
    $stmt = $conn->prepare("SELECT id, nombre, apellidos, telefono FROM telefonos");
    $stmt->execute();
  
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $matrizresultado = $stmt->fetchAll();
    echo $matrizresultado[2]["nombre"];
    echo "<hr>";
    foreach($matrizresultado as $registro) {
        echo $registro["nombre"];
        echo " ";
        echo $registro["apellidos"];
        echo " ";
        echo "<a href='?id=" . $registro["id"] . "'>Borrar</a>";
        echo "<br>";
    }

    
///   foreach($stmt->fetchAll() as $k=>$v) {
///     echo $v["nombre"];
///     echo "<br>";
///   }

  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

$conn = null;
?>