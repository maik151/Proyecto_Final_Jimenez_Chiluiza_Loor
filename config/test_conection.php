<?php
// Incluir el archivo donde está la clase Database
include_once 'Database.php';

// Crear una instancia de la clase Database
$database = new Database();

// Intentar conectar a la base de datos
$conn = $database->conectar();

// Verificar si la conexión fue exitosa
if (isset($conn)) {
    echo "Conexión exitosa a la base de datos.";
    $
} else {
    echo "Error al conectar a la base de datos.";
}
?>