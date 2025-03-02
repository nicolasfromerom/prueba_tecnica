<?php

use Nicolasfromerom\PruebaTecnica\Core\Router;

require_once '../vendor/autoload.php';

header('Content-Type: application/json');

$router = new Router();

// Definir rutas
$router->get('/', 'HomeController@index');
$router->get('/about', 'HomeController@about');

// Ejecutar enrutador
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
