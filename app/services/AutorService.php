<?php
    require_once __DIR__.'/../models/Autor.php';
    require_once __DIR__.'/../repositories/AutoresRepository.php';

    class AutorService{
         private $autorRepository;
         
         public function __construct($db){
            $this->autorRepository = new AutorRepository($db);
         }

         public function getAll(){
            $stmt = $this->autorRepository->readALL();
            $result = [];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result[] = $row;

            }
            return $result;
         }

         public function getById($id_autor){
            $data = $this->autorRepository->readOne($id_autor);
            return $data;
        }

        public function create($data){
            $autor = new Autor();
            $autor->setNombreAutor($data->nombre_autor);
            $autor->setEdad($data->edad_autor);
            $autor->setNacionalidad($data->nacionalidad);
            $autor->setGenero($data->genero);

            return $this->autorRepository->create($autor);
        }

        public function update($data){
            $autor = new Autor();
            $autor->setNombreAutor($data->nombre_autor);
            $autor->setEdad($data->edad_autor);
            $autor->setNacionalidad($data->nacionalidad);
            $autor->setGenero($data->genero);
            $autor->setIdAutor($data->id_autor);


            return $this->autorRepository->update($autor);   
        }


        public function delete($id_autor){
            $data = $this->autorRepository->delete($id_autor);
            return $data;
        }


    }


?>