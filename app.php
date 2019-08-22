#!/usr/bin/php
<?php

// Load the autoloader of vendors (composer).
require __DIR__ . '/vendor/autoload.php';
// Load our own custom classes, so it's apart from our app.
include_once __DIR__ . '/class_log.php';
include_once __DIR__ . '/class_db_map.php';
include_once __DIR__ . '/class_custom.php';

// Making the functions simpler accessible by using 'use' command.
// Hence, now you don't need to use FaaPz\PDO\Database, but simply 'Database' as example.
use CHH\Optparse;
use FaaPz\PDO\Database;
use Monolog\Logger;
use Laravie\Parser\Xml\Reader;
use Laravie\Parser\Xml\Document;

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
    'user' => 'test',
    'pass' => 'test',
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
$logger->info('Starting the application...');

// Let's check the database connection, and when it works we can use it.
try {
    $pdo = new Database($database_dsn, $database['user'], $database['pass']);
} catch (Exception $e) {
    $logger->error('Error trying to test MySQL!');
    $logger->error('Error: ' . $e->getMessage());
    exit(1);
}
$logger->info('Connection with MySQL host ' . $database['host'] . ' created.');

// MySQL connection established, let's actually do something.
$cmdparser = new Optparse\Parser();

function usage()
{
    global $cmdparser, $logger;
    $logger->info("{$cmdparser->usage()}");
    exit(1);
}

$cmdparser->addFlag('help', ['alias' => '-h'], 'usage');
$cmdparser->addFlag('force', ['alias' => '-f']);
$cmdparser->addArgument('file_or_folder', ['required' => true]);

try {
    $cmdparser->parse();
} catch (Optparse\Exception $e) {
    usage();
}

// Check if file or folder exists, and if not, return error.
if (!file_exists($cmdparser['file_or_folder'])) {
    $logger->error('File or Folder "' . $cmdparser['file_or_folder'] . '" does not exist !');
    exit(1);
}
if (!is_file($cmdparser['file_or_folder']) && !is_dir($cmdparser['file_or_folder'])) {
    $logger->error('Object "' . $cmdparser['file_or_folder'] . '" is not a file or a folder !');
    exit(1);
}

// Okay it looks fine, let's check if the source is a folder, or file.
// Depending on this, we handle it.
$logger->info('Checking if a file or folder is requested.');
$extensions = ['xml'];
$files = [];
if (is_dir($cmdparser['file_or_folder'])) {
    $logger->info('The source is a folder, scanning...');
    $folder = new RecursiveDirectoryIterator($cmdparser['file_or_folder']);
    foreach (new RecursiveIteratorIterator($folder) as $file) {
        $check_array = explode('.', $file);
        if (in_array(strtolower(end($check_array)), $extensions)) {
            $files[] = $file->getPathName();
        }
    }
}
if (is_file($cmdparser['file_or_folder'])) {
    $logger->info('The source is a file.');
    $check_array = explode('.', $cmdparser['file_or_folder']);
    if (in_array(strtolower(end($check_array)), $extensions)) {
        $files[] = $cmdparser['file_or_folder'];
    }
}

// We have now a file list (or single file in the array) to be parsed.
// Let's parse the XML file.
// You can set a flag to continue with the next file, even if the file is corrupted or invalid.
foreach ($files as $file) {
    try {
        $logger->info('Parsing file ' . $file);
        $xml = (new Reader(new Document()))->load($file);
        if ($xml === null) {
            // File is not parsable, depending on the force flag we either give a error or warning.
            if ($cmdparser['force']) {
                $logger->warning('The file ' . $file . ' was unable to be parsed, continue...');
                continue;
            }
            $logger->error('The file ' . $file . ' was unable to be parsed, exiting...');
            exit(1);
        }

        // XML is parsed, now let's validate if all the components are inside against the mapping.
        $mapping = new db_map();
        foreach ($mapping->map as $key1 => $value1) {
            $logger->info('Validating mapping key ' . $key1 . ' ...');
            foreach ($value1 as $key2 => $value2) {
                $logger->debug('Validating key ' . $key2 . ' against XML data ' . $value2);
                $keys = explode('|', $value2);
                $data = custom_functions::validate_object($xml->getContent(), $keys);
                if ($data === false) {
                    if ($cmdparser['force']) {
                        $logger->warning('The key ' . $value2 . ' could not be found in the XML, skipping XML...');
                        continue 2;
                    }
                    $logger->error('The key ' . $value2 . ' could not be found in the XML, exiting...');
                    exit(1);
                }
            }
        }
        // XML data contains everything we need to dump it into MySQL !
        $logger->info('Parsing mapping key ' . $key1 . ' for writing to database ...');
    } catch (Exception $e) {
        if ($cmdparser['force']) {
            $logger->warning('A unexpected error occurred while parsing ' . $file . ', continue...');
            continue;
        }
        $logger->error('A unexpected error occurred while parsing ' . $file . ', exiting...');
        exit(1);
    }
}

$logger->info('Parser has run successfully, exiting.');

exit(0);
