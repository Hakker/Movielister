<?php

error_reporting(E_ALL);

$it = new RecursiveDirectoryIterator("./jav/");
$display = Array ('xml', 'nfo');
$file = "";
foreach(new RecursiveIteratorIterator($it) as $file)
{
    $explodedShit = explode('.', $file);
    if (in_array(strtolower(array_pop($explodedShit)), $display)) {
        $loadXML = json_decode(json_encode(simplexml_load_string(file_get_contents($file), "SimpleXMLElement", LIBXML_NOCDATA)), true);
        $result = parseIt($loadXML);
        if ($result !== false) {
            echo "Parsed file " . $file . " into Database, next !\n";
        } else {
            echo "Houston we have an error, try again...\n";
            die();
        }
    }
}

function parseIt($data) {
	$host = 'localhost';
	$db   = 'deb3842_javtest';
	$user = 'deb3842_javmanager';
	$pass = '2ATa76RuROHE';
	$charset = 'utf8mb4';

	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
	$options = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false,
	];
	
	try {
		$pdo = new PDO($dsn, $user, $pass, $options);
	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int)$e->getCode());
	}

    //$link = mysqli_connect("77.163.24.90", "javmanager", "2ATa76RuROHE", "javtest");
    echo "Parse the shit...\n\n";

	$insertData = [];
	foreach ($data as $key => $value) {
        if (is_array($value)) {
            echo "Array Key: " . strtolower($key) . " : JSON Value: " . json_encode($value) . "\n";
			$insertData[strtolower($key)] = json_encode($value);
        } else {
            echo "Key: " . strtolower($key) . " : " . $value . "\n";
			$insertData[strtolower($key)] = $value;
        }
    }
	echo "Loaded it all\n\n";
	
	$stmt = $pdo->prepare("INSERT INTO user (:column_string) VALUES (:value_string);");
	$stmt->bindParam(':column_string', implode(',', array_keys($insertData)));
	$stmt->bindParam(':value_string', implode(',', array_values($insertData)));
	$stmt->execute();
	echo "Stored it in the hive mind\n\n";
	
	//$link = mysql_query(;
	
    unset($pdo);
}
