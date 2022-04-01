<?php

class Model
{
    public $tableName;
    public $validations;
    public static $dbConnection;

    public function loadStmtParams($data)
    {
        // Prepearte the bind data
        $bindFields = '';
        $bindString = '';
        $bindParams = '';

        // Add the bind parameters
        foreach ($data as $field => $data) {
            $bindFields .= "`{$field}`,";
            $bindString .= '?,';
    
            if (is_numeric($data)) {
                $bindParams .= 'i';
            } else {
                $bindParams .= 's';
            }
        }

        // Remove traling commas
        $bindFields = rtrim($bindFields, ',');
        $bindString = rtrim($bindString, ',');
        $bindParams = rtrim($bindParams, ',');

        return ['fields' => $bindFields, 'values' => $bindString, 'params' => $bindParams];
    }

    public function insertRow($data)
    {
        $stmtParts = $this->loadStmtParams($data);
        $sql       = "INSERT INTO `{$this->tableName}` ({$stmtParts['fields']}) VALUES ({$stmtParts['values']})";
        // Build the statement
        $stmt = static::$dbConnection->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param($stmtParts['params'], ...(array_values($data)));
        return $stmt->execute();
    }

    public function updateRowById($id, $data)
    {
        $stmtParts = $this->loadStmtParams($data);
        $sql       = "UPDATE `{$this->tableName}` SET";

        // Add the updated fields
        foreach ($data as $field => $value) {
            $sql .= " `{$field}` = ?,";
        }
        $sql = rtrim($sql, ',');

        $sql .= ' WHERE id = ' . $id;

        // Build the statement
        $stmt = static::$dbConnection->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param($stmtParts['params'], ...(array_values($data)));
        return $stmt->execute();
    }

    public function readRowById($id)
    {   
        $id = (int) $id;
        $sql = "SELECT * FROM `{$this->tableName}` WHERE id = $id";
        $stmt = static::$dbConnection->stmt_init();
        $stmt->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function readRowBySlug($slug)
    {   
        $sql = "SELECT * FROM `{$this->tableName}` WHERE slug = '$slug'";
        $stmt = static::$dbConnection->stmt_init();
        $stmt->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function deleteRowById($id)
    {
        $sql = "DELETE FROM `{$this->tableName}` WHERE id = $id";
        return mysqli_query(static::$dbConnection, $sql); 
    }
    
    public function readAll()//($order, $conditions)
    {
        $sql = "SELECT * FROM `{$this->tableName}`";
        return mysqli_query(static::$dbConnection, $sql);
    }

    public function checkSlug($slug) {
        $sql = "SELECT * FROM `{$this->tableName}` WHERE slug = '$slug'";
        return mysqli_query(static::$dbConnection, $sql);
    }

    public function getLastId() {
        $sql = "SELECT LAST_INSERT_ID()";
        $result = mysqli_query(static::$dbConnection, $sql);
        return $result = $result->fetch_row()[0];

    }

    public function getImages($id)
    {
        $imageTable = 'images';
        $sql = "SELECT * FROM `{$imageTable}` WHERE related_post_id = $id AND format != 'webp'";
        return mysqli_query(static::$dbConnection, $sql);
    }

    public function getWebpImages($id)
    {
        $imageTable = 'images';
        $sql = "SELECT * FROM `{$imageTable}` WHERE related_post_id = $id AND format = 'webp'";
        return mysqli_query(static::$dbConnection, $sql);
    }

    public function matchIdBySlug($slug)
    {
        $sql = "SELECT id FROM `{$this->tableName}` WHERE slug = '$slug'";
        return mysqli_query(static::$dbConnection, $sql);
    }

    public function addComment($data)
    {
        $commentsTable = 'reviews';
        $stmtParts = $this->loadStmtParams($data);
        $stmt = static::$dbConnection->stmt_init();
        $sql = "INSERT INTO `{$commentsTable}` ({$stmtParts['fields']}) VALUES ({$stmtParts['values']})";
        $stmt->prepare($sql);
        $stmt->bind_param($stmtParts['params'], ...(array_values($data)));
        return $stmt->execute();
    }

    public function getComments($slug)
    {
        $commentsTable = 'reviews';
        $sql = "SELECT * FROM `{$commentsTable}` WHERE related_post_id = $slug";
        return mysqli_query(static::$dbConnection, $sql);
    }
}