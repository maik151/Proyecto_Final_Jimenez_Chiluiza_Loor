
<?php
// Configurar encabezados para respuestas JSON y permitir CORS.
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// // Incluir el enrutador y los controladores.
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/controllers/LibroController.php';
require_once __DIR__ . '/../app/controllers/AutorController.php';

$router = new Router();

// Rutas para Libros.
$libroController = new LibroController();
$router->add('GET', '/libros', fn() => $libroController->index());
$router->add('GET', '/libros/:id', fn($id) => $libroController->show($id));
$router->add('POST', '/libros', fn() => $libroController->store());
$router->add('PUT', '/libros/:id', fn($id) => $libroController->update($id));
$router->add('DELETE', '/libros/:id', fn($id) => $libroController->destroy($id));

// // Rutas para Autores.
$autorController = new AutorController();
$router->add('GET', '/autores', fn() => $autorController->index());
$router->add('GET', '/autores/:id', fn($id) => $autorController->show($id));
$router->add('POST', '/autores', fn() => $autorController->store());
$router->add('PUT', '/autores/:id', fn($id) => $autorController->update($id));
$router->add('DELETE', '/autores/:id', fn($id) => $autorController->destroy($id));

// Obtener la URI solicitada.
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = '/Proyecto_Final_Jimenez_Chiluiza_Loor/public'; // Ajusta si está en un subdirectorio.
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}
if ($uri == '') {
    $uri = '/';
}

// Despachar la petición.
$router->dispatch($_SERVER['REQUEST_METHOD'], $uri);
header('Location: /Proyecto_Final_Jimenez_Chiluiza_Loor/public/templates/gestion.php');
exit(); // Asegura que el código no continúe ejecutándose después de la redirección.

?>