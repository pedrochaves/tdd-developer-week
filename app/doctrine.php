<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

$db_params = [
    'driver' => 'pdo_mysql',
    'user' => 'imasters',
    'password' => 'imasters',
    'dbname' => 'calculator',
];

$config = Setup::createAnnotationMetadataConfiguration([__DIR__ . '/../src/Event'], true);

return ($em = EntityManager::create($db_params, $config));
