<?php
require_once(MODEL_PATH . 'Database.php');

// Check if there is a connection already
if ($settings['db_connection'] !== null) {
	return;
}


// Enable error reporting for mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
// Handle execpetion errors
try {
	$settings['db_connection'] = new mysqli(
		$settings['database']['host'],
		$settings['database']['user'],
		$settings['database']['pass'],
	);
} catch (Exception $e) {
	echo renderTemplate(ROOT_PATH . 'error.php', ['error' => $e->getMessage()]);
	return;
}




// Handle default errors
if ($settings['db_connection']->connect_errno) {
	echo renderTemplate(ROOT_PATH . 'error.php', ['error' => $mysqli->connect_error]);
	return;
}


// Set charset
$settings['db_connection']->set_charset('utf8mb4');
if ($settings['db_connection']->errno) {
    echo renderTemplate(ROOT_PATH . 'error.php', ['error' => $settings['db_connection']->error]);
	return;
}


// Handle missing database
$dbExists = (bool) $settings['db_connection']->query(
	"SELECT COUNT(*) AS `exists` FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMATA.SCHEMA_NAME='{$settings['database']['name']}'"
)->fetch_object()->exists;

// Create database and tablse
if (!$dbExists) {
	// Create the database
	$settings['db_connection']->query($settings['database_schema']['database']);
	$settings['db_connection']->select_db($settings['database']['name']);
	
	
	// Create the tables
	$settings['db_connection']->query($settings['database_schema']['posts_table']);
	$settings['db_connection']->query($settings['database_schema']['images_table']);
	$settings['db_connection']->query($settings['database_schema']['customers_table']);
}

