<?php
    class Database{
        private $host = 'localhost';
        private $db_name = 'bd_libros_autores';
        private $username_db = 'root';
        private $password_db = '';

        public $connexion;

        public function conectar(){
            $this->conn=null;
            
            try{
                $this->connexion = new PDO(
                    'mysql:host='.$this->host.'; dbname='.$this->db_name, 
                    $this->username_db, 
                    $this->password_db);
                $this->connexion->exec('set names utf8');    
            }catch(\PDOException $exception){
                echo 'ERROR DE CONEXION: '.$exception->getMessage();
            }
            return $this->connexion;
            
        }

    }

?>