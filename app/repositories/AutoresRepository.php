<?php
// Incluimos el modelo de Autor
require_once __DIR__.'/../models/Autor.php';

class AutorRepository{
    private $conn;
    private $table_name = "autor";

    public function __construct($db){
        $this->conn = $db;
    }

    public function create(Autor $autor) {
        $query = "INSERT INTO {$this->table_name} (nombre_autor, edad_autor, nacionalidad, genero) 
                  VALUES (:nombre_autor, :edad_autor, :nacionalidad, :genero)";
        
        $stmt = $this->conn->prepare($query);
        
        // Asegúrate de que estas variables estén definidas correctamente
        $nombre_autor = $autor->getNombreAutor();
        $edad_autor = $autor->getEdad();
        $nacionalidad = $autor->getNacionalidad();
        $genero = $autor->getGenero();
    
        // Asocia los parámetros con los valores
        $stmt->bindParam(":nombre_autor", $nombre_autor);
        $stmt->bindParam(":edad_autor", $edad_autor);
        $stmt->bindParam(":nacionalidad", $nacionalidad);
        $stmt->bindParam(":genero", $genero);
    
        // Ejecuta la consulta
        $stmt->execute();
        return $stmt;
    }

    public function readAll(){
        $query = "SELECT * FROM {$this->table_name}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    public function update(Autor $autor){
        $query = "UPDATE {$this->table_name} SET 
                    nombre_autor = :nombre_autor, 
                    edad_autor = :edad_autor, 
                    nacionalidad = :nacionalidad, 
                    genero = :genero 
                    WHERE id_autor = :id_autor"; 

        $stmt = $this->conn->prepare($query);
        // Asociamos los parámetros con los valores obtenidos del objeto $libro
        $nombre_autor = $autor->getNombreAutor();
        $edad_autor = $autor->getEdad();
        $nacionalidad = $autor->getNacionalidad();
        $genero = $autor->getGenero();
        $id_autor=$autor->getIdAutor();
    
        // Asocia los parámetros con los valores
        $stmt->bindParam(":nombre_autor", $nombre_autor);
        $stmt->bindParam(":edad_autor", $edad_autor);
        $stmt->bindParam(":nacionalidad", $nacionalidad);
        $stmt->bindParam(":genero", $genero);
        $stmt->bindParam(":id_autor", $id_autor);
        
        $stmt->execute();
        return $stmt;
    }

    public function delete($id_autor){
        $query = "DELETE FROM {$this->table_name} WHERE id_autor = :id_autor";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_autor", $id_autor);
        $stmt->execute();
        return $stmt;

    }

    public function readOne($id_autor){
        $query = "SELECT * FROM {$this->table_name} WHERE id_autor = :id_autor LIMIT 1"; 
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":id_autor",$id_autor);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    
    }

}


?>