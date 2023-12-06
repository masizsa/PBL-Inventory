<?php
require_once "Database.php";

class Crud {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    //Add peminjaman 
    public function addPeminjaman ($nomor_identitas, $tanggal){
    $query = "INSERT INTO peminjaman (nomor_identitas, tgl_peminjaman) VALUES ('$nomor_identitas','2024-09-08')";
    $result = $this->db->conn->query($query);
    return $result;
    }
}