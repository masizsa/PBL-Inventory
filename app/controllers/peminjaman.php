<?php
class Peminjaman extends Controller{
    public $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }


    public function index(){
        $data = array();
        $data= $this->konfirmasiPeminjaman();
        $this->view("templates/header");
        $this->view("templates/sidebar-admin");
        $this->view("admin/peminjaman/index",$data);
        $this->view("templates/footer");
    }

    public function konfirmasiPeminjaman(){
        $conn = $this->db->getConnection();
        $data = [];
            $sql = "SELECT * FROM data_peminjaman ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row; // Tambahkan data ke array riwayatData
                    // var_dump($data);
                }
            }
            return $data;
        

    }
}