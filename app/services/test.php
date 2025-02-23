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
$autorService1 = new AutorService($conn);
$libroService1 = new LibroService($conn);

$idEliminar = 3; 


// Datos del nuevo autor (modifica estos valores para probar)
$autorData = new stdClass();
$autorData->id_autor = 3; // Asegúrate de que este ID exista en tu base de datos
$autorData->nombre_autor = "Nuevo Nombre";
$autorData->edad_autor = 45;
$autorData->nacionalidad = "Ecuadoriana";
$autorData->genero = "Masculino";

$resultado = $autorService1->update($autorData);



// Llamar a la función getALL() para obtener todos los libros
// $borrado1 = $autorService1->delete($idEliminar);

$resultados1 = $autorService1->getById($idEliminar);
$resultados2 = $libroService1->getALL();

// Verificar si se han obtenido resultados

if ($resultados1) {
    echo "Autor encontrado: <br>";
        echo "ID: " . $resultados1['id_autor'] . "<br>";
        echo "Nombre: " . $resultados1['nombre_autor'] . "<br>";
        echo "Edad: " . $resultados1['edad_autor'] . "<br>";
        echo "Nacinalidad: " . $resultados1['nacionalidad'] . "<br>";
        echo "Género: " . $resultados1['genero'] . "<br><br>";
    
} else {
    echo "No se encontro el autor en la base de datos.";
}

// if (!empty($resultados1)) {
//     echo "Autores encontrados: <br>";
//     foreach ($resultados1 as $autor) {
//         echo "ID: " . $autor['id_autor'] . "<br>";
//         echo "Nombre: " . $autor['nombre_autor'] . "<br>";
//         echo "Edad: " . $autor['edad_autor'] . "<br>";
//         echo "Nacinalidad: " . $autor['nacionalidad'] . "<br>";
//         echo "Género: " . $autor['genero'] . "<br><br>";
//     }
// } else {
//     echo "No se encontraron AUTORES en la base de datos.";
// }




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

