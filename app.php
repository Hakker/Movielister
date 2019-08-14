<?php

// Load the autoloader of vendors (composer).
require __DIR__ . '/vendor/autoload.php';
// Load our own custom classes, so it's apart from our app.
include_once __DIR__ . '/class_log.php';

// Making the functions simpler accessible by using 'use' command.
// Hence, now you don't need to use FaaPz\PDO\Database, but simply 'Database' as example.
use CHH\Optparse;
use FaaPz\PDO\Database;
use Monolog\Logger;

/**
 * Configuration, set here some of the configs if needed.
 */

/**
 * Database configuration.
 * Set this to make access to MySQL accessible.
 */
$database = [
    'host' => 'localhost',
    'port' => 3306,
    'user' => 'root',
    'pass' => 'root',
    'db'   => 'movielister',
    'char' => 'utf8'
];
// Do not edit the dsn, this generates the URI to connect to MySQL from above info.
$database_dsn = sprintf(
    'mysql:host=%s;port=%s;dbname=%s;charset=%s',
    $database['host'],
    $database['port'],
    $database['db'],
    $database['char']
);

/**
 * LogLevels: DEBUG, INFO, NOTICE, WARNING, ERROR, CRITICAL, ALERT, EMERGENCY
 * For this software we only use: DEBUG, INFO, WARNING and ERROR
 */
$log_level = Logger::DEBUG;
$log_file = 'app.log';
$log_screen = true;

// Let's initialize the logger
$logger = new Log('Movielister', $log_level, $log_file, $log_screen);
$logger->debug('Starting the application...');

// Let's check the database connection, and when it works we can use it.
try {
    $pdo = new Database($database_dsn, $database['user'], $database['pass']);
} catch (Exception $e) {
    $logger->error('Error trying to test MySQL!');
    $logger->error('Error: ' . $e->getMessage());
    exit(1);
}
$logger->debug('Connection with MySQL host ' . $database['host'] . ' created.');

// MySQL connection established, let's actually do something.

exit(0);
