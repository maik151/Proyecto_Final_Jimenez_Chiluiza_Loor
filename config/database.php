<?php
    class Database {
        // Definimos las variables necesarias para la conexión a la base de datos
        private $host = 'localhost'; // Dirección del servidor de base de datos (en este caso, 'localhost' para conexión local)
        private $db_name = 'bd_libros_autores'; // El nombre de la base de datos a la que te conectarás
        private $username_db = 'root'; // Usuario de MySQL, en este caso 'root' es el usuario predeterminado
        private $password_db = ''; // Contraseña de MySQL, en este caso es vacía por defecto en muchos entornos locales
    
        public $connexion; // Esta variable será utilizada para almacenar la conexión a la base de datos
    
        // Método para realizar la conexión a la base de datos
        public function conectar(){
            // Inicializamos la conexión en null (vacío) para asegurarnos de que no haya una conexión previa
            $this->conn = null;
    
            try {
                // Usamos el objeto PDO (PHP Data Objects) para realizar la conexión a la base de datos
                $this->connexion = new PDO(
                    'mysql:host=' . $this->host . '; dbname=' . $this->db_name, // Configuración de la conexión: host (servidor) y dbname (base de datos)
                    $this->username_db, // Nombre de usuario para la conexión
                    $this->password_db  // Contraseña para la conexión
                );
    
                // Configuración para usar la codificación UTF-8 en la base de datos (para manejar caracteres especiales)
                $this->connexion->exec('set names utf8');    
    
            } catch(\PDOException $exception) {
                // Si ocurre un error en la conexión, se captura la excepción y se muestra un mensaje de error
                echo 'ERROR DE CONEXION: ' . $exception->getMessage(); // El mensaje del error se obtiene con $exception->getMessage()
            }
    
            // Devuelve el objeto de conexión (si la conexión fue exitosa, $this->connexion tendrá el objeto PDO)
            return $this->connexion;
        }
    }

?>