<?php

require __DIR__ . '/vendor/autoload.php';

/**
 * Configuration, set here some of the configs if needed.
 */

/**
 * LogLevels: DEBUG, INFO, NOTICE, WARNING, ERROR, CRITICAL, ALERT, EMERGENCY
 * For this software we only use: DEBUG, INFO, WARNING and ERROR
 */
$log_level = Monolog\Logger::DEBUG;
$log_screen = true;


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
    echo "Error trying to open log file, exitting...\n";
    exit(1);
}

$logger = new Log($log_to_file, $log_to_screen);
$logger->debug("Starting the application...");

exit(0);

class Log
{
    private $pointer_log1;
    private $pointer_log2;

    function __construct($pointer_log1, $pointer_log2)
    {
        $this->pointer_log1 = $pointer_log1;
        $this->pointer_log2 = $pointer_log2;
    }

    function debug($text)
    {
        if ($this->pointer_log1 !== null) {
            $this->pointer_log1->debug($text);
        }
        if ($this->pointer_log2 !== null) {
            $this->pointer_log2->debug($text);
        }
    }

    function info($text)
    {
        if ($this->pointer_log1 !== null) {
            $this->pointer_log1->info($text);
        }
        if ($this->pointer_log2 !== null) {
            $this->pointer_log2->info($text);
        }
    }

    function warning($text)
    {
        if ($this->pointer_log1 !== null) {
            $this->pointer_log1->warning($text);
        }
        if ($this->pointer_log2 !== null) {
            $this->pointer_log2->warning($text);
        }
    }

    function error($text)
    {
        if ($this->pointer_log1 !== null) {
            $this->pointer_log1->error($text);
        }
        if ($this->pointer_log2 !== null) {
            $this->pointer_log2->error($text);
        }
    }
}