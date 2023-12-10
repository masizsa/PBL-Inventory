<?php
class BarangDipinjam extends Controller
{
    public $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }


    public function index()
    {
        $data = array();
        $data['barang'] = $this->getDataBarang();
        $this->view("templates/header");
        $this->view("templates/sidebar-user");
        $this->view("user/barang-dipinjam/index",$data);
        $this->view("templates/footer");
    }

    public function getDataBarang(){
        $conn = $this->db->getConnection();
        $nomor_identitas = $_SESSION['nomor_identitas'];
        $query = "SELECT tgl_peminjaman, tgl_pengembalian,id_barang,nama_barang, nama_admin, jumlah FROM riwayat WHERE username_peminjam = '$nomor_identitas'";
        $result_set = $conn->query($query);
        $result = [];
        if ($result_set->num_rows > 0) {
            // Memasukkan hasil query ke dalam array
            while ($row = $result_set->fetch_assoc()) {
                $result[] = $row;
            }
        }

        return $result;
    }

    
}
