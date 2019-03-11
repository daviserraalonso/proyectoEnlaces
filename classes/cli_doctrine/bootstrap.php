<?php

require_once("../vendor/autoload.php");
require_once("../autoload.php");

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use izv\app\App;

$paths = array('./src'); //Le decimos donde estan las clases pojo para trabajar con ellas
$isDevMode = false; //para que de más o menos errores, false = menos, true = más

$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => App::USER,
    'password' => App::PASSWORD,
    'dbname' => App::DATABASE
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create ($dbParams, $config); //Objeto gestor