<?php

require_once '../vendor/autoload.php';

use Nicolasfromerom\PruebaTecnica\Core\EventDispatcher;
use Nicolasfromerom\PruebaTecnica\Core\Router;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Application\UseCase\RegisterUserUseCase;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Infrastructure\Http\RegisterUserController;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Infrastructure\Persistence\DoctrineUserRepository;

// $eventDispatcher = new EventDispatcher();

// // Suscribimos el manejador del evento
// $eventDispatcher->subscribe(UserRegisteredEvent::class, function ($event) {
//     $handler = new SendWelcomeEmailHandler();
//     $handler->handle($event);
// });

// $registerUserUseCase = new RegisterUserUseCase($userRepository, $eventDispatcher);


header('Content-Type: application/json');

$entityManager = require_once '../src/config/doctrine.php';


$router = new Router();

// Definir rutas
$userRepository = new DoctrineUserRepository($entityManager);
$eventDispatcher = new EventDispatcher();
$registerUserUseCase = new RegisterUserUseCase($userRepository, $eventDispatcher);

// Pasar la instancia del caso de uso al controlador
$router->post('/users', function () use ($registerUserUseCase) {
    (new RegisterUserController($registerUserUseCase))->register();
});

// Ejecutar enrutador
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
