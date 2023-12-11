<?php
class RiwayatUser extends Controller
{
    public $db;
    public $nomor_identitas;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    public function index()
    {
        $data = array();
        $data = $this->getData();
        $data['css'] = 'riwayat';
        $this->view("templates/header", $data);
        $this->view("templates/sidebar-user");
        $this->view("user/riwayat/index", $data);
        $this->view("templates/footer");
    }

    public function getData()
    {
        $conn = $this->db->getConnection();
        $data = [];
        if (isset($_SESSION["nomor_identitas"])) {
            $nomor_identitas = $_SESSION["nomor_identitas"];
            $sql = "SELECT * FROM riwayat WHERE username_peminjam = '$nomor_identitas'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row; // Tambahkan data ke array riwayatData
                    // var_dump($data);
                }
            } else {
                // Handle jika query tidak mengembalikan hasil atau terjadi kesalahan
            }
        } else {
            // Handle jika nilai nomor_identitas tidak tersedia dalam sesi
        }

        // Memastikan untuk mengembalikan nilai $data dari fungsi
        return $data;
    }

    public function searchData()
    {
        // $search = $_POST['search'];
        // $query = "SELECT * FROM  riwayat WHERE nama_barang LIKE :search";
        // $this->db->query($query);
        // $this->db->bind('search', "$search");
        // return $this->db->resultSet();
    }
}
