<?php
class RiwayatAdmin extends Controller
{
    public $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function index()
    {

        $data['desc'] = $this->showRecent();
        $data['asc'] = $this->showOldest();
        $data['datas'] = $this->showRecent();
        $data['css'] = 'riwayat-admin';
        // $data['riwayat_past'] = this->showOldest();
      
        $this->view("templates/header", $data);
        $this->view("templates/sidebar-admin");
        $this->view("admin/riwayat/riwayat-admin", $data);
        $this->view("templates/footer");
    }

    public function showRecent()
    {
        $conn = $this->db->getConnection();
        $data = [];

        $query = "SELECT * FROM riwayat ORDER BY tgl_peminjaman DESC";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row; // Tambahkan data ke array riwayatData
                // var_dump($data);
            }
        }
        return $data;
    }

    public function showOldest()
    {
        $conn = $this->db->getConnection();
        $dataAsc = [];

        $query = "SELECT * FROM riwayat ORDER BY tgl_peminjaman ASC";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dataAsc[] = $row; // Tambahkan data ke array riwayatData
                // var_dump($data);
            }
        }
        return $dataAsc;
    }
    public function searchData()
    {
        $key = $_POST['key'];
        $query = "SELECT * FROM  riwayat WHERE nama_barang LIKE :key";
        $this->db->query($query);
        $this->db->bind('key', "$key");
        return $this->db->resultSet();
    }
}