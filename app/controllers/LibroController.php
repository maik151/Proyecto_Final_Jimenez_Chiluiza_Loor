<?php
    require_once __DIR__.'/../services/LibroService.php';
    require_once __DIR__ . '/../../config/database.php';

    class LibroController{

        private $libroService;

        public function __construct(){
            $database = new Database();
            $db = $database->conectar();
            $this->libroService = new LibroService($db);
        }

        public function index(){
            $result = $this->libroService->getAll();
            echo json_encode($result);
        }

        public function show($id){
            $result = $this->libroService->getById($id);
            if($result){
                echo json_encode($result);
            }else{
                http_response_code(404);
                echo json_encode(['mensaje'=>'CATEGORIA NO ENCONTRADA']);
            }
        }

        
    }




?>