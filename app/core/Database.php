<?php
class Database
{
    public static $instance = null;
    private $conn;

    public function __construct()
    {
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'inventory';
        $this->conn = new mysqli($host, $username, $password, $database);

        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    public function query($query)
    {
        $result = $this->conn->query($query);
        if (!$result) {
            die('Query error: ' . $this->conn->error);
        }
        return $result;
    }

    public static function getInstance(){
        if (!isset(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    } 
    public function getConnection(){
        return $this->conn;
    }
}
