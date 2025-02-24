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
            // Obtener el cuerpo de la solicitud
            $data = json_decode(file_get_contents("php://input"));
        
            // Verificar si los datos fueron correctamente decodificados
            if ($data === null) {
                http_response_code(400); // Si no es JSON válido
                echo json_encode(['mensaje' => 'Datos no válidos. Asegúrate de enviar un JSON correctamente formateado.']);
                return;
            }
        
            // Validar que los campos requeridos no estén vacíos
            if (!empty($data->titulo_libro) && !empty($data->ISBN) && !empty($data->id_autor) && !empty($data->genero_libro)) {
                // Llamar al servicio para crear el libro
                $result = $this->libroService->create($data);
                
                // Verificar el resultado de la creación
                if ($result) {
                    http_response_code(201); // Respuesta 201 para recursos creados
                    echo json_encode(['mensaje' => 'Libro creado correctamente.']);
                } else {
                    http_response_code(500); // Error en el servidor
                    echo json_encode(['mensaje' => 'Error al crear el libro. Inténtalo de nuevo.']);
                }
            } else {
                // Si faltan campos requeridos
                http_response_code(400);
                echo json_encode(['mensaje' => 'Datos incompletos. Todos los campos son requeridos.']);
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
            // Asegúrate de que solo se elimina el libro con la ID proporcionada
            $result = $this->libroService->delete($id);
        
            if ($result) {
                http_response_code(200);
                echo json_encode(['mensaje' => 'Libro eliminado correctamente']);
            } else {
                http_response_code(500);
                echo json_encode(['mensaje' => 'Error al eliminar el libro']);
            }
        }
    }




?>