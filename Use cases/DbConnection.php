<?php

class DbConnection
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database_name = "phardb";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database_name", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function closeConnection()
    {
        $this->conn = null;
    }
}
