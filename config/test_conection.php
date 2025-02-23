<?php
// Incluir el archivo donde está la clase Database
include_once 'database.php';

// Crear una instancia de la clase Database
$databaseCreated = new Database();

// Intentar conectar a la base de datos
$conn = $databaseCreated->conectar();

// Verificar si la conexión fue exitosa
if (isset($conn)) {
    
    echo "Conexión exitosa a la base de datos.";
    //Probamos que la conexion funciona....
    $query = "SELECT * FROM autor";
    $stmt = $conn->prepare($query); 

    $stmt->execute();
    $stmt  = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Mostrar los libros obtenidos
    print_r($stmt);
    
} else {
    echo "Error al conectar a la base de datos.";
}
?>