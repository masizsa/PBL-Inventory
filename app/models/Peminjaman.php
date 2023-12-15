<?php
require_once "Database.php"; //(Za ini aku pakai Database yg ada di models, buat nyoba" tok sik an)
//  require_once "../core/Database.php"; (Lek aku pakai ini error -> require_once(../core/Database.php): Failed to open stream: No such file or directory in C:\xampp\htdocs\dasarWeb\PBL-Inventory\app\models\Peminjaman.php on line 3
//Kalau aku ga pakek apa" seperti yg kamu jelasin pas meet, iku database e not foundd, jadi buat ngetes aku pakai Databse sg ndek file iki

class Crud
{
    private $db;

    public function __construct()
    {
        $this->db = new database();
    }
    //Add peminjaman 
    public function addPeminjaman($tanggal)
    {
        // var_dump($tanggal);
        $query = "INSERT INTO peminjaman (nomor_identitas, tgl_peminjaman) VALUES ('2241720036','$tanggal')"; // sementa
        $result = $this->db->conn->query($query);
        return $result;
    }
}
