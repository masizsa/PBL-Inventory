<?php 

class pilihBarang extends Controller
{
    private $db;

    public function __construct()
        {
            $this->db = Database::getInstance();
        }

    public function getDataBarang()
    {
        $conn = $this->db->getConnection();
        if ($conn->connect_error) {
            die('Koneksi database gagal: ' . $conn->connect_error);
        }
        $sql = "SELECT a.id_barang, a.nama_barang, a.id_admin, a.jumlah_tersedia, b.nama_admin FROM barang a INNER JOIN admin b ON a.id_admin = b.id_admin";
        $result = $conn->query($sql);
        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function index()
    {
        $data = array();
        $data = $this->getDataBarang();
        $this->view("templates/header");
        $this->view("user/pilihBarang/index", $data);
        $this->view("templates/footer");
    }
}
?>