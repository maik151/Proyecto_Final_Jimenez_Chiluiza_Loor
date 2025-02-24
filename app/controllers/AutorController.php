<?php
    require_once __DIR__.'/../services/AutorService.php';
    require_once __DIR__ . '/../../config/database.php';

    class AutorController {

        private $autorService;

        public function __construct(){
            $database = new Database();
            $db = $database->conectar();
            $this->autorService = new AutorService($db);
        }

        // Listar todos los autores.
        public function index(){
            $result = $this->autorService->getAll();
            echo json_encode($result);
        }

        // Mostrar un autor específico por ID.
        public function show($id){
            $result = $this->autorService->getById($id);
            if ($result) {
                echo json_encode($result);
            } else {
                http_response_code(404);
                echo json_encode(['mensaje' => 'Autor no encontrado']);
            }
        }

        // Crear un nuevo autor.
        public function store() {
            $data = json_decode(file_get_contents("php://input"));
            if (!empty($data->nombre) && !empty($data->biografia)) {
                $result = $this->autorService->create($data);
                if ($result) {
                    http_response_code(201);
                    echo json_encode(['mensaje' => 'Autor creado correctamente']);
                } else {
                    http_response_code(500);
                    echo json_encode(['mensaje' => 'Error al crear el autor']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['mensaje' => 'Datos incompletos']);
            }
        }

        // Actualizar un autor existente.
        public function update($id) {
            $data = json_decode(file_get_contents("php://input"));
            if (!empty($data->nombre) && !empty($data->biografia)) {
                $result = $this->autorService->update($id, $data);
                if ($result) {
                    echo json_encode(['mensaje' => 'Autor actualizado']);
                } else {
                    http_response_code(500);
                    echo json_encode(['mensaje' => 'Error al actualizar el autor']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['mensaje' => 'Datos incompletos']);
            }
        }

        // Eliminar un autor.
        public function destroy($id) {
            if ($this->autorService->delete($id)) {
                echo json_encode(['mensaje' => 'Autor eliminado']);
            } else {
                http_response_code(404);
                echo json_encode(['mensaje' => 'Autor no encontrado']);
            }
        }
    }
?>