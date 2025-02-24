<?php
class Router {
    private $routes = []; // Aquí almacenaremos todas las rutas

    // Agregar rutas
    public function add($method, $route, $callback) {
        $this->routes[] = [
            'method'   => strtoupper($method), // Método HTTP (GET, POST, PUT, DELETE)
            'route'    => $route,               // Ruta como '/libros' o '/libros/:id'
            'callback' => $callback             // La función que se ejecutará
        ];
    }

    // Disparar la ruta correspondiente
    public function dispatch($method, $uri) {
        foreach ($this->routes as $route) {
            // Verifica que el método y la ruta coincidan
            if ($route['method'] === strtoupper($method) && preg_match($this->convertRoute($route['route']), $uri, $params)) {
                array_shift($params); // Quitar el primer elemento que es la ruta completa
                return call_user_func_array($route['callback'], $params); // Ejecutar la función con los parámetros
            }
        }
        // Si no se encontró la ruta, devuelve 404
        http_response_code(404);
        echo json_encode(['message' => 'Not Found']);
    }

    // Convertir la ruta en una expresión regular
    private function convertRoute($route) {
        // Convierte las rutas dinámicas de la forma /libros/:id a expresiones regulares
        return "#^" . preg_replace('/\\\:[a-zA-Z0-9_]+/', '([a-zA-Z0-9_-]+)', preg_quote($route)) . "$#";
    }
}