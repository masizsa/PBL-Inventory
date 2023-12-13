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
        // Periksa apakah terjadi request POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['confirmBtn'])) {
                $id_peminjaman =  intval($_POST['update']);
                // Panggil fungsi updateStatusToDipinjam dengan menggunakan $_POST['id_peminjaman']
                $this->updateStatusToDipinjam($id_peminjaman);
            }
            if(isset($_POST['confirmBtnPengembalian'])){
                $id_peminjamans =  intval($_POST['updateSelesai']);
                $this->updateStatusToSelesai($id_peminjamans);

            }
        }

        // Tetapkan data yang diperlukan untuk tampilan
        $data = array();
        $data['items'] = $this->konfirmasiPeminjaman();
        $data['items2'] = $this->konfirmasasiPengembalian();
        $data['css'] = 'adminPeminjaman';

        // Tampilkan tampilan template setelah pemrosesan request POST
        $this->view("templates/header", $data);
        $this->view("templates/sidebar-admin");
        $this->view("admin/peminjaman/index", $data);
        $this->view("templates/footer");
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
        $this->updateToTerlambat();
        $conn = $this->db->getConnection();
        $data = [];
        $sql = "SELECT * FROM data_pengembalian where status != 'Menunggu' AND status != 'Selesai'";
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
        $sql = "UPDATE peminjaman SET status = 'Dipinjam' WHERE id_peminjaman = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idPeminjaman);
        $stmt->execute();
    }

    public function updateStatusToSelesai($idPeminjaman){
        $conn = $this->db->getConnection();
        $sql = "UPDATE peminjaman SET status = 'Selesai' WHERE id_peminjaman = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idPeminjaman);
        $stmt->execute();
    }

    public function updateToTerlambat(){
            $conn = $this->db->getConnection();
            $sql = "UPDATE peminjaman SET status = 'Terlambat' WHERE tgl_pengembalian < CURDATE() AND status = 'Dipinjam';";
            $stmt = $conn->prepare($sql);
            // $stmt->bind_param("i", $idPeminjaman);
            $stmt->execute();
    }

    


}
