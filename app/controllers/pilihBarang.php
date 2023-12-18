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
        $sql = "SELECT b.id_barang, b.nama_barang, b.id_admin, b.jumlah_tersedia, a.nama_admin FROM barang b INNER JOIN admin a ON b.id_admin = a.id_admin";
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