<?php
// Define the database 
class Database
{
    private $conn;
    public function __construct($host, $username, $password, $database)
    {
        try {
            $this->conn = new PDO('mysql:host=' . $host . ';dbname=' . $database, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
    public function prepare($sql)
    {
        return $this->conn->prepare($sql);
    }

    public function lastInsertedId()
    {
        return $this->conn->lastInsertId();
    }
}