<?php

require __DIR__ . '/vendor/autoload.php';

$log = new Monolog\Logger('movielister');
$log->pushHandler(new Monolog\Handler\StreamHandler('app.log', Monolog\Logger::WARNING));
