<?php
    //Inicio de las rutas
    class router{
        private $routes = [];

        public function add($method, $route, $callback){
            $this->routes[]=[
                'method' => strtoupper($method),
                'route' => $route,
                'callback' => $callback
            ];

        }

        public function dispatch($method, $uri){
            foreach($this->routes as $routes){
                if($route['method'] === strtoupper($method) && pregu_match($this->convertRoute($route['route']), $uri, $params)){       
                    array_shift($params);
                    return call_user_func_array($route['callback'], $params);
                }
            }

        }

        public function convertRoute($route){


        }

    }

?>

