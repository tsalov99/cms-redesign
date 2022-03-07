<?php

include_once('Database.php');

class Connection extends Database
{
    private $connection;
    
    public function __construct() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->name);
        } catch (Exception $e) {
        echo renderTemplate(ROOT_PATH . 'error.php', ['error' => $e->getMessage()]);
        return;
    }
    }
}