<?php

$em = require __DIR__ . '/app/doctrine.php';

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($em);
