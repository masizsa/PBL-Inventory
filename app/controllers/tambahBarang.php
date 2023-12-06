<?php
class TambahBarang extends Controller
{
    public $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    public function index()
    {
        $data = $this->getDataBarang();
        $this->view("templates/header");
        $this->view("templates/sidebar-admin");
        $this->view("admin/tambah-barang/index", $data);
        $this->view("templates/footer");
    }

    public function addBarang()
    {
        $conn = $this->db->getConnection();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $kode_barang = $_POST['kode_barang'];
            $nama_barang = $_POST['nama_barang'];
            $asal = $_POST['asal'];
            $jumlah = $_POST['jumlah'];
            $keterangan = $_POST['keterangan'];

            $query = "INSERT INTO barang (id_barang, nama_barang, jumlah_tersedia, kondisi_barang, asal) 
          VALUES ('$kode_barang', '$nama_barang', $jumlah, '$keterangan', '$asal')";

            echo "<br>";
            echo $query;
            if ($conn->query($query) === TRUE) {
                echo "Barang berhasil ditambahkan ke dalam database.";
            } else {
                echo "Error: " . $query . "<br>" . $conn->error;
            }
        } else {
            echo "Metode tidak diizinkan.";
        }
    }

    public function editBarang(){
        $conn = $this->db->getConnection();
    }

    public function getDataBarang(){
        $conn = $this->db->getConnection();
        $query = "SELECT id_barang, nama_barang, jumlah_tersedia, kondisi_barang, asal FROM barang";
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
