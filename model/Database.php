<?php

$host = $settings['database']['host'];
$name = $settings['database']['user'];
$pass = $settings['database']['pass'];
$dbName = $settings['database']['name'];

class Database {

    public function __construct($host, $user, $pass, $dbName) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try
        {
            $this->connection = new mysqli($host, $user, $pass, $dbName);
        } catch (Exception $e) {
            echo renderTemplate(ROOT_PATH . 'error.php', ['error' => $e->getMessage()]);
            return;
        }
    }
}