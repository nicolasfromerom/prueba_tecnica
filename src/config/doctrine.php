<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

$paths = [__DIR__ . '/../src'];
$isDevMode = true;

// Configuración de la conexión a la base de datos
$dbParams = [
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'users',
];

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

return $entityManager;
