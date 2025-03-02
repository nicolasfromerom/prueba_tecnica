<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

require_once '../vendor/autoload.php';

$paths = [__DIR__ . '/../src'];
$isDevMode = true;

// Configuración de la conexión a la base de datos
$cache = new ArrayAdapter();
$config = ORMSetup::createAttributeMetadataConfiguration([__DIR__ . '/../src/Domain/Entity'], $isDevMode, null, $cache);


$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql',
    'host' => '127.0.0.1',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'prueba-tecnica',
], $config);


$entityManager = new EntityManager($connection, $config);

return $entityManager;
