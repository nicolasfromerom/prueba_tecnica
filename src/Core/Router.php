<?php
namespace Nicolasfromerom\PruebaTecnica\Core;

class Router {
    private $routes = [];

    public function get($uri, $controller) {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller) {
        $this->routes['POST'][$uri] = $controller;
    }

    public function dispatch($uri, $method) {
        // Obtener solo la parte del path (sin parámetros ni dominio)
        $uri = parse_url($uri, PHP_URL_PATH);
        
        // Normalizar URI para entornos como Laragon (ajustar según sea necesario)
        $basePath = '/prueba-tecnica'; // Ajusta esto si la estructura cambia
        $uri = str_replace($basePath, '', $uri);
        $handler = $this->routes[$method][$uri] ?? null;

        if ($handler instanceof \Closure) {
            call_user_func($handler);
            return;
        }

        // Verificar si la ruta está registrada
        if (is_string($handler)) {
            list($controller, $action) = explode('@', $this->routes[$method][$uri]);
            
            $controllerClass = "Nicolasfromerom\\PruebaTecnica\\TechnicalTestContext\\User\\Infrastructure\\Http\\$controller";

            // Verificar si la clase existe antes de instanciar
            if (!class_exists($controllerClass)) {
                http_response_code(500);
                echo json_encode(["error" => "Controller '$controllerClass' not found"]);
                exit;
            }

            $controllerInstance = new $controllerClass();
            
            // Verificar si el método existe
            if (!method_exists($controllerInstance, $action)) {
                http_response_code(500);
                echo json_encode(["error" => "Method '$action' not found in controller '$controllerClass'"]);
                exit;
            }

            $controllerInstance->$action();
        } else {
            http_response_code(404);
            echo json_encode(["error" => "404 - Not Found", "uri" => $uri]);
        }
    }
}
