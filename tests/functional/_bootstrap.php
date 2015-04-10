<?php

$app = require __DIR__ . '/../../app/bootstrap.php';
$app['debug'] = true;
$app['exception_handler']->disable();

return $app;
