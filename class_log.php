<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Log
{
    private $log_file;
    private $log_screen;

    function __construct($log_name, $log_level, $log_file, $log_screen)
    {
        // Let's initialize the logger
        if ($log_file !== false) {
            try {
                $this->log_file = new Logger($log_name);
                $this->log_file->pushHandler(new StreamHandler($log_file, $log_level));
            } catch (Exception $e) {
                echo "Error trying to open log file!\n";
                echo "Error: " . $e->getMessage() . "\n";
                exit(1);
            }
        } else {
            $this->log_file = null;
        }

        if ($log_screen !== false) {
            try {
                $this->log_screen = new Logger($log_name);
                $this->log_screen->pushHandler(new StreamHandler('php://stdout', $log_level));
            } catch (Exception $e) {
                echo "Error trying to open log file!\n";
                echo "Error: " . $e->getMessage() . "\n";
                exit(1);
            }
        } else {
            $this->log_screen = null;
        }
    }

    function debug($text)
    {
        if ($this->log_file !== null) {
            $this->log_file->debug($text);
        }
        if ($this->log_screen !== null) {
            $this->log_screen->debug($text);
        }
    }

    function info($text)
    {
        if ($this->log_file !== null) {
            $this->log_file->info($text);
        }
        if ($this->log_screen !== null) {
            $this->log_screen->info($text);
        }
    }

    function warning($text)
    {
        if ($this->log_file !== null) {
            $this->log_file->warning($text);
        }
        if ($this->log_screen !== null) {
            $this->log_screen->warning($text);
        }
    }

    function error($text)
    {
        if ($this->log_file !== null) {
            $this->log_file->error($text);
        }
        if ($this->log_screen !== null) {
            $this->log_screen->error($text);
        }
    }
}