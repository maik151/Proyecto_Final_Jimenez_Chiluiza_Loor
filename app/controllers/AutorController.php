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

        public function index(){
            $result = $this->autorService->getAll();
            echo json_encode($result);
        }

        public function show($id){
            $result = $this->autorService->getById($id);
            if ($result) {
                echo json_encode($result);
            } else {
                http_response_code(404);
                echo json_encode(['mensaje' => 'AUTOR NO ENCONTRADO']);
            }
        }

        public function store() {
            $data = json_decode(file_get_contents("php://input"));
            
            if ($data === null) {
                http_response_code(400);
                echo json_encode(['mensaje' => 'Datos no válidos. Asegúrate de enviar un JSON correctamente formateado.']);
                return;
            }
            
            if (!empty($data->nombre_autor) && !empty($data->edad_autor) && !empty($data->nacionalidad) && !empty($data->genero)) {
                $result = $this->autorService->create($data);
                if ($result) {
                    http_response_code(201);
                    echo json_encode(['mensaje' => 'Autor creado correctamente.']);
                } else {
                    http_response_code(500);
                    echo json_encode(['mensaje' => 'Error al crear el autor. Inténtalo de nuevo.']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['mensaje' => 'Datos incompletos. Todos los campos son requeridos.']);
            }
        }

        public function update($id) {
            // Leer los datos JSON enviados en la solicitud

            $data = json_decode(file_get_contents("php://input"));

            if(!empty($data->nombre_autor) && !empty($data->edad_autor) && !empty($data->nacionalidad) && !empty($data->genero))
            {
                $result = $this->autorService->update($data);
                // Comprobar si la actualización fue exitosa
                if ($result) {
                    echo json_encode(['mensaje' => 'Libro actualizado correctamente']);
                } else {
                    http_response_code(500);
                    echo json_encode(['mensaje' => 'Error al actualizar el libro']);
                }
            }else{
                // Si faltan datos, devolver un error 400
                http_response_code(400);
                echo json_encode(['mensaje' => 'Datos incompletos']);    

            }
        }
        public function destroy($id) {
            $result = $this->autorService->delete($id);
        
            if ($result) {
                http_response_code(200);
                echo json_encode(['mensaje' => 'Autor eliminado correctamente']);
            } else {
                http_response_code(404); // <- 404 si no se encuentra el autor
                echo json_encode(['mensaje' => 'Autor no encontrado']);
            }
        }
    }
?>
