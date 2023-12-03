<?php
class Database
{
    public $host = 'localhost';
    public $username = 'root';
    public $password = '';
    public $database = 'inventory';

    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    public function query($query){
        $result = $this->conn->query($query);
        if (!$result) {
            // Jika query gagal, Anda bisa menangani atau log pesan kesalahan
            die('Query error: ' . $this->conn->error);
        }
        return $result;
    }
}
