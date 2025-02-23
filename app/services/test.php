<?php
// Incluir la configuración de la base de datos
require_once __DIR__ . '/../../config/database.php';

// Incluir el servicio de libro
require_once __DIR__ . '/../services/AutorService.php';
require_once __DIR__ . '/../services/LibroService.php';

// Crear la conexión a la base de datos
$database = new Database();
$conn = $database->conectar();

// Instanciar el servicio de libro
// $autorService1 = new AutorService($conn);
$libroService1 = new LibroService($conn);

$idEliminar = 5; 


// Datos del nuevo autor (modifica estos valores para probar)
$libroData = new stdClass(); // Asegúrate de que este ID exista en tu base de datos
$libroData->titulo_libro = "badman";
$libroData-> ISBN= "EEUU-1457567";
$libroData->id_autor = "3";
$libroData->genero_libro = "Comics";

// $resultado = $libroService1->create($libroData);



// Llamar a la función getALL() para obtener todos los libros
// $borrado1 = $autorService1->delete($idEliminar);




//Mostrar unico libro por ID
$resultados2 = $libroService1->delete(3);

if ($resultados2){
    echo 'Libro eliminado correctamente';
    
} else {
    echo "No se encontro dicho libro para elminar";
}

$resultados2 = $libroService1->getALL();
// Verificar si se han obtenido resultados
//Tabla de libros
if (!empty($resultados2)) {
    echo "Libros encontrados: <br>";
    foreach ($resultados2 as $libro) {
        echo "ID: " . $libro['id_libro'] . "<br>";
        echo "Titulo: " . $libro['titulo_libro'] . "<br>";
        echo "ISBN: " . $libro['ISBN'] . "<br>";
        echo "Id_Autor: " . $libro['id_autor'] . "<br>";
        echo "Género: " . $libro['genero_libro'] . "<br><br>";
    }
} else {
    echo "No se encontraron libros en la base de datos.";
}