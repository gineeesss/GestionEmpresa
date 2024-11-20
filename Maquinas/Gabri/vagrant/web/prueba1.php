<?php
$servername = "127.0.0.1";
$username = "root";
$password = "toor";
$basedatos = "prueba1";

try {
    $conn = new PDO("mysql:host=$servername;dbname=prueba1", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

  // Insertar registros
//   try {
//     $sql = "INSERT INTO telefonos (nombre, apellidos, telefono)
//     VALUES ('John', 'Doe', '638482838')";
//     // use exec() because no results are returned
//     $conn->exec($sql);
//     echo "New record created successfully";
//   } catch(PDOException $e) {
//     echo $sql . "<br>" . $e->getMessage();
//   }

  // Prepared Statements: INSERT
//   try {
//     // prepare sql and bind parameters
//     $stmt = $conn->prepare("INSERT INTO telefonos (nombre, apellidos, telefono)
//     VALUES (:firstname, :lastname, :phone)");
//     $stmt->bindParam(':firstname', $firstname);
//     $stmt->bindParam(':lastname', $lastname);
//     $stmt->bindParam(':phone', $phone);
  
//     // insert a row
//     $firstname = "Jane";
//     $lastname = "Doe";
//     $phone = "647827472";
//     $stmt->execute();
  
//     // insert another row
//     $firstname = "Mary";
//     $lastname = "Moe";
//     $phone = "647274727";
//     $stmt->execute();
  
//     // insert another row
//     $firstname = "Julie";
//     $lastname = "Dooley";
//     $phone = "647274727";
//     $stmt->execute();
  
//     echo "New records created successfully";
//   } catch(PDOException $e) {
//     echo "Error: " . $e->getMessage();
//   }

  // Prepared Statements: SELECT
  try {
    // prepare sql and bind parameters
    $stmt = $conn->prepare("SELECT id, nombre, apellidos, telefono FROM telefonos");
    $stmt->execute();
    
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $matrizresultado = $stmt->fetchAll();

    echo "<br>";
    // Imprime el nombre del tercer elemento (el [2]) de los registros, que se han metido en $matrizresultado
    echo $matrizresultado[2]["nombre"];
    echo "<br>";
    var_dump($matrizresultado);

    foreach($matrizresultado as $registro) {
        echo "<hr>";
        echo $registro["id"] . " ";
        echo $registro["nombre"] . " ";
        echo $registro["apellidos"] . " ";
        echo $registro["telefono"] . " ";
    }
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

  $conn = null;
  ?>