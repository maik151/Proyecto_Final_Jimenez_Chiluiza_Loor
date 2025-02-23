<?php
    
// Incluimos el modelo de Libro
require_once __DIR__.'/../models/Libro.php';
include_once  __DIR__.'/../../config/database.php';
class LibrosRepository {

    private $conn; // Variable para almacenar la conexión a la base de datos
    private $table_name = "libro"; // Nombre de la tabla en la base de datos

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db) { 
        $this->conn = $db; // Asignamos la conexión a la propiedad $conn
    }

    // Método para crear un nuevo libro
    public function create(Libro $libro) { 
        // Consulta SQL para insertar un nuevo libro en la tabla 'libro'
        $query = "INSERT INTO {$this->table_name} (titulo_libro, ISBN, id_autor, genero_libro) 
                  VALUES (:titulo_libro, :ISBN, :id_autor, :genero_libro)"; 

        // Preparamos la consulta para ejecutarla en la base de datos
        $stmt = $this->conn->prepare($query); 

        // Asociamos los parámetros con los valores obtenidos del objeto $libro
        $stmt->bindParam(":titulo_libro", $libro->getTituloLibro()); 
        $stmt->bindParam(":ISBN", $libro->getISBN()); 
        $stmt->bindParam(":id_autor", $libro->getIdAutor()); 
        $stmt->bindParam(":genero_libro", $libro->getGeneroLibro()); 

        // Ejecutamos la consulta y retornamos el resultado
        return $stmt->execute(); 
    }

    // Método para leer todos los libros
    public function readAll(){
        // Consulta SQL para obtener todos los registros de libros
        $query = "SELECT * FROM {$this->table_name}"; 
        $stmt = $this->conn->prepare($query); // Preparamos la consulta
        $stmt->execute(); // Ejecutamos la consulta
        return $stmt; // Retornamos el objeto de la sentencia preparada para su posterior manipulación
    }

    // Método para actualizar un libro
    public function update(Libro $libro){ 
        // Consulta SQL para actualizar un libro basado en su 'id_libro'
        $query = "UPDATE {$this->table_name} SET titulo_libro = :titulo_libro, ISBN = :ISBN, 
                  id_autor = :id_autor, genero_libro = :genero_libro WHERE id_libro = :id_libro"; 
        
        // Preparamos la consulta
        $stmt = $this->conn->prepare($query); 

        // Asociamos los parámetros con los valores del objeto $libro
        $stmt->bindParam(":titulo_libro", $libro->getTituloLibro()); 
        $stmt->bindParam(":ISBN", $libro->getISBN()); 
        $stmt->bindParam(":id_autor", $libro->getIdAutor()); 
        $stmt->bindParam(":genero_libro", $libro->getGeneroLibro()); 
        $stmt->bindParam(":id_libro", $libro->getIdLibro()); // Asociamos 'id_libro' para actualizar el libro específico

        // Ejecutamos la consulta y retornamos el resultado
        return $stmt->execute(); 
    }

    // Método para eliminar un libro
    public function delete($id_libro){ 
        // Consulta SQL para eliminar el libro usando su 'id_libro'
        $query = "DELETE FROM {$this->table_name} WHERE id_libro = :id_libro"; 
        
        // Preparamos la consulta
        $stmt = $this->conn->prepare($query); 
        
        // Asociamos el parámetro ':id_libro' con el valor proporcionado
        $stmt->bindParam(":id_libro", $id_libro); 

        // Ejecutamos la consulta y retornamos el resultado
        return $stmt->execute(); 
    }
    
    // Método para leer un solo libro por su 'id_libro'
    public function readOne($id_libro){ 
        // Consulta SQL para obtener un solo libro basado en su 'id_libro'
        $query = "SELECT * FROM {$this->table_name} WHERE id_libro = :id_libro LIMIT 0,1"; 
        
        // Preparamos la consulta
        $stmt = $this->conn->prepare($query); 
        
        // Asociamos el parámetro ':id_libro' con el valor proporcionado
        $stmt->bindParam(":id_libro", $id_libro); 
        
        // Ejecutamos la consulta
        $stmt->execute(); 
        
        // Retornamos el primer resultado como un array asociativo
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }




}


//INSTANCIAS DE PRUBA PARA VERIFICAR EL FUNCIONAMIENTO.
// creo un objeto de tipo database el cual guarda la conexxion

$databasePrueba = new Database();

// obtenemos el objeto de conexion PDO 
$conn = $databasePrueba->conectar();

// creamos una instancia de lirboRepository 

$libroPrueba = new LibrosRepository($conn);

$libroPrueba->readAll();



?>