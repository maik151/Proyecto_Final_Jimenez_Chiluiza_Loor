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

        public function store() {
            $data = json_decode(file_get_contents("php://input"));
            if (!empty($data->titulo) && !empty($data->autor) && !empty($data->anio)) {
                $result = $this->libroService->create($data);
                if ($result) {
                    http_response_code(201);
                    echo json_encode(['mensaje' => 'Libro creado correctamente']);
                } else {
                    http_response_code(500);
                    echo json_encode(['mensaje' => 'Error al crear el libro']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['mensaje' => 'Datos incompletos']);
            }
        }
        
        public function update($id) {
            $data = json_decode(file_get_contents("php://input"));
            if (!empty($data->titulo) && !empty($data->autor) && !empty($data->anio)) {
                $result = $this->libroService->update($id, $data);
                if ($result) {
                    echo json_encode(['mensaje' => 'Libro actualizado']);
                } else {
                    http_response_code(500);
                    echo json_encode(['mensaje' => 'Error al actualizar el libro']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['mensaje' => 'Datos incompletos']);
            }
        }

        public function destroy($id) {
            if ($this->libroService->delete($id)) {
                echo json_encode(['mensaje' => 'Libro eliminado']);
            } else {
                http_response_code(404);
                echo json_encode(['mensaje' => 'Libro no encontrado']);
            }
        }
    }




?>