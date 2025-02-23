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

        public function getById($id){
            $data = $this->libroRepository->readOne($id);
            return $data ? $data:null;
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
            $libro->setTituloLibro($data->titulo_libro);
            $libro->setISBN($data->ISBN);
            $libro->setIdAutor($data->id_autor);
            $libro->setGeneroLibro($data->genero_libro);
            $libro->setIdLibro($data->id_libro);

            return $this->libroRepository->update($libro);   
        }


        public function delete($id){
            return $this->libroRepository->delete($id);
        }

    }

?>