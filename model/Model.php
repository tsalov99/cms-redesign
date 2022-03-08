<?php

class Model
{
    public $tableName;
    public $validations;
    public $dbConnection;
    
    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function loadStmtParams($data)
    {
        // Prepearte the bind data
        $bindFields = '';
        $bindString = '';
        $bindParams = '';

        // Add the bind parameters
        foreach ($data as $field => $data) {
            $bindFields .= "'{$field}',";
            $bindString .= '?,';

            if (is_numeric($bindParams)) {
                $bindParams .= 'i';
            } else {
                $bindParams .= 's';
            }
        }

        // Remove traling commas
        rtrim($bindFields, ',');
        rtrim($bindString, ',');

        return ['fields' => $bindFields, 'values' => $bindString, 'params' => $bindParams];
    }

    public function insetRow($data)
    {
        $stmtParts = $this->loadStmtParams();
        $sql       = "INSERT INTO `{$this->tableName}` ({$stmtParts['fields']}) VALUES ({$stmtParts['values']})";

        // Build the statement
        $stmt = $this->dbConnection->stmt_init($sql);
        $stmt->bind_param($stmtParts['params'], ...$data);
        return $stmt->execute();
    }

    public function updateRowById($id, $data)
    {
        $stmtParts = $this->loadStmtParams();
        $sql       = "UPDATE `{$this->tableName}` SET";

        // Add the updated fields
        foreach ($data as $field => $value) {
            $sql .= " `{$field}` = ?";
        }

        $sql .= ' WHERE id = ' . $id;

        // Build the statement
        $stmt = $this->dbConnection->stmt_init($sql);
        $stmt->bind_param($stmtParts['params'], ...$data);
        return $stmt->execute();
    }

    public function readRowById($id)
    {
        
    }

    public function deleteRowById($id)
    {
        
    }
    
    public function readAll()//($order, $conditions)
    {
        $sql = "SELECT * FROM `{$this->tableName}`";
        return mysqli_query($this->dbConnection, $sql);
    }
}