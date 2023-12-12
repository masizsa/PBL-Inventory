<?php
class Peminjaman extends Controller
{
    public $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }


    public function index()
    {
        $data = array();
        $data['items'] = $this->konfirmasiPeminjaman();
        $data['items2'] = $this->konfirmasasiPengembalian();
        $data['css'] = 'adminPeminjaman';
        $this->view("templates/header", $data);
        $this->view("templates/sidebar-admin");
        $this->view("admin/peminjaman/index", $data);
        $this->view("templates/footer");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['action'] === 'updateToPeminjaman') {
                // Panggil fungsi updateToPeminjaman dengan menggunakan $_POST['id_peminjaman']
                $id_peminjaman = $_POST['id_peminjaman'];
                // updateStatusToDipinjam($id_peminjaman); // Pastikan fungsi ini ada dan sesuai dengan kebutuhan Anda
            }
        }
    }

    public function konfirmasiPeminjaman()
    {
        $conn = $this->db->getConnection();
        $data = [];
        $sql = "SELECT * FROM data_peminjaman where status = 'Menunggu' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row; // Tambahkan data ke array riwayatData
                // var_dump($data);
            }
        }
        return $data;
    }

    public function konfirmasasiPengembalian()
    {
        $conn = $this->db->getConnection();
        $data = [];
        $sql = "SELECT * FROM data_peminjaman where status != 'Menunggu' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row; // Tambahkan data ke array riwayatData
                // var_dump($data);
            }
        }
        return $data;
    }

    public function updateStatusToDipinjam($idPeminjaman)
    {
        $conn = $this->db->getConnection();
        $sql = "UPDATE data_peminjaman SET status = 'Dipinjam' WHERE id_peminjaman = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $idPeminjaman);
        $stmt->execute();
    }
}
