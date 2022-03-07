<?php

class Database {
    private $host;
    private $user;
    private $pass;
    private $dbName;

    private function connect($host, $user, $pass, $dbName) {
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