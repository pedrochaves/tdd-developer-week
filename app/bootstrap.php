<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/views',
    'twig.options' => [
        'debug' => $app['debug']
    ]
));

$app['em'] = require __DIR__ . '/doctrine.php';

require __DIR__ . '/routes.php';

return $app;
