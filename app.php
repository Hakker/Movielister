<?php

// Load the autoloader of vendors (composer).
require __DIR__ . '/vendor/autoload.php';
// Load our own custom classes, so it's apart from our app.
include_once __DIR__ . '/class_log.php';

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
$log_level = Monolog\Logger::DEBUG;
$log_screen = true;

// Let's initialize the logger
$log_to_file = new Monolog\Logger('movielister');
try {
    $log_to_file = new Monolog\Logger('movielister');
    $log_to_screen = new Monolog\Logger('movielister');

    $log_to_file->pushHandler(new Monolog\Handler\StreamHandler('app.log', $log_level));
    if ($log_screen === true) {
        $log_to_screen->pushHandler(new Monolog\Handler\StreamHandler('php://stdout', $log_level));
    } else {
        $log_to_screen = null;
    }
} catch (Exception $e) {
    echo "Error trying to open log file!\n";
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}

$logger = new Log($log_to_file, $log_to_screen);
$logger->debug('Starting the application...');

// Let's check the database connection, and when it works we can use it.
try {
    $pdo = new \FaaPz\PDO\Database($database_dsn, $database['user'], $database['pass']);
} catch (Exception $e) {
    $logger->error('Error trying to test MySQL!');
    $logger->error('Error: ' . $e->getMessage());
    exit(1);
}
$logger->debug('Connection with MySQL host ' . $database['host'] . ' created.');

// MySQL connection established, let's actually do something.

exit(0);
