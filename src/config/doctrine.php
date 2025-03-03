<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

require_once '../vendor/autoload.php';

$isDevMode = true;

// Configuración de la conexión a la base de datos
$cache = new ArrayAdapter();
$config = ORMSetup::createAttributeMetadataConfiguration([__DIR__ . '/../src/Domain/Entity'], $isDevMode, null, $cache);


$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql',
    'host' => 'db',
    'user'     => 'root',
    'password' => 'rootpassword',
    'dbname'   => 'pruebatecnica',
    'port' => 3306,
], $config);


$entityManager = new EntityManager($connection, $config);

return $entityManager;
