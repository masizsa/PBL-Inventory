<?php
class AjukanPeminjaman extends Controller
{
    public $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    public function index()
    {
        $data = array();
        $data['items'] = $this->getData();
        $data['css'] = 'pilih-barang';
        $this->view("templates/header", $data);
        $this->view("templates/sidebar-user");
        $this->view("user/pilih-barang/index", $data);
        $this->view("templates/footer");
    }

    public function getData()
    {
        $conn = $this->db->getConnection();
        $data = [];
        $sql = "SELECT * FROM data_barang_user";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row; // Tambahkan data ke array riwayatData
                // var_dump($data);
            }
        } else {
            // Handle jika query tidak mengembalikan hasil atau terjadi kesalahan
        }


        // Memastikan untuk mengembalikan nilai $data dari fungsi
        return $data;
    }
}
