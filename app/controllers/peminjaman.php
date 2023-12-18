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

        $updateStatus = new PeminjamanModel($conn);
        $updateStatus->updateStatusPeminjaman($idPeminjaman);

        $detailPeminjaman = new DetailPeminjamanModel($conn);
        $result = $detailPeminjaman->getIdBarangAndJumlahByIdPeminjaman($idPeminjaman);

        $items[] = $result->fetch_assoc();

        var_dump($items);

        // Lakukan UPDATE untuk setiap id_barang yang ditemukan
        foreach ($items as $item) {
            $sqlUpdateBarang = "UPDATE barang SET jumlah_tersedia = jumlah_tersedia - ?, jumlah_dipinjam = jumlah_dipinjam + ? WHERE id_barang = ?";
            $stmtUpdateBarang = $conn->prepare($sqlUpdateBarang);
            $stmtUpdateBarang->bind_param("iis", $item['jumlah'], $item['jumlah'], $item['id_barang']);
            $stmtUpdateBarang->execute();
        }

        // header('Location: /peminjaman');
    }



    public function updateStatusToSelesai($idPeminjaman)
    {
        $conn = $this->db->getConnection();
        // Update status peminjaman
        $sqlPeminjaman = "UPDATE peminjaman SET status = 'Selesai' WHERE id_peminjaman = ?";
        $stmtPeminjaman = $conn->prepare($sqlPeminjaman);
        $stmtPeminjaman->bind_param("i", $idPeminjaman);
        $stmtPeminjaman->execute();
        $sqlBarang = "SELECT id_barang, jumlah FROM detail_peminjaman WHERE id_peminjaman = ?";
        $stmtBarang = $conn->prepare($sqlBarang);
        $stmtBarang->bind_param("i", $idPeminjaman);
        $stmtBarang->execute();
        $result = $stmtBarang->get_result();

        $items = [];
        while ($item = $result->fetch_assoc()) {
            $items[] = $item;
        }

        // Lakukan UPDATE untuk setiap id_barang yang ditemukan
        foreach ($items as $item) {
            $sqlUpdateBarang = "UPDATE barang SET jumlah_tersedia = jumlah_tersedia + ?, jumlah_dipinjam = jumlah_dipinjam - ? WHERE id_barang = ?";
            $stmtUpdateBarang = $conn->prepare($sqlUpdateBarang);
            $stmtUpdateBarang->bind_param("iis", $item['jumlah'], $item['jumlah'], $item['id_barang']);
            $stmtUpdateBarang->execute();
        }
        $sql = "UPDATE peminjaman SET status = 'Selesai' WHERE id_peminjaman = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idPeminjaman);
        $stmt->execute();
        $sql = "UPDATE users SET kesempatan = kesempatan + 1  WHERE nomor_identitas = (Select nomor_identitas from peminjaman where id_peminjaman = $idPeminjaman)";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

    }


    public function updateToTerlambat()
    {
        $conn = $this->db->getConnection();
        $sql = "UPDATE peminjaman SET status = 'Terlambat' WHERE tgl_pengembalian < CURDATE() AND status = 'Dipinjam';";
        $stmt = $conn->prepare($sql);
        // $stmt->bind_param("i", $idPeminjaman);
        $stmt->execute();
    }
    
}
