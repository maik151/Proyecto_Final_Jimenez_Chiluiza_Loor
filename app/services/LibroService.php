<?php
    
    require_once __DIR__.'/../models/Libro.php';
    require_once __DIR__.'/../repositories/LibrosRepository.php';
    

    class LibroService{
        private $libroRepository;

        public function __construct($db){
            $this->libroRepository = new LibrosRepository($db);
        }

        public function getALL(){
            $stmt = $this->libroRepository->readALL();
            $result = [];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result[]=$row;
            }
            return $result;
        }

        public function getById($id_libro){
            $data = $this->libroRepository->readOne($id_libro);
            return $data;
        }

        public function create($data){
            $libro = new Libro();
            $libro->setTituloLibro($data->titulo_libro);
            $libro->setISBN($data->ISBN);
            $libro->setIdAutor($data->id_autor);
            $libro->setGeneroLibro($data->genero_libro);

            return $this->libroRepository->create($libro);
        }

        public function update($data){

            
            $libro = new Libro();
            $libro->setIdLibro($data->id_libro);
            $libro->setTituloLibro($data->titulo_libro);
            $libro->setISBN($data->ISBN);
            $libro->setIdAutor($data->id_autor);
            $libro->setGeneroLibro($data->genero_libro);

            return $this->libroRepository->update($libro);   
        }


        public function delete($id_libro){
            $data = $this->libroRepository->delete($id_libro);
            return $data;
        }

    }

?>