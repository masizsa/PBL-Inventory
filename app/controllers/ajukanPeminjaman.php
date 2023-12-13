<?php
class AjukanPeminjaman extends Controller
{
    public $db;
    public $listDataBarang;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    public function index()
    {
        $data['cookies'] = isset($_COOKIE['myCookie']) ? $_COOKIE['myCookie'] : null;
        $data['datas'] = $this->getDataBarang();
        $data['css'] = 'pilih-barang';

        $this->view("templates/header", $data);
        $this->view("templates/sidebar-user");
        $this->view("user/pilih-barang/index", $data);
        $this->view("templates/footer");
    }
    public function getDataBarang()
    {
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM data_barang_user";

        // Menjalankan query
        $result = $conn->query($sql);

        // Memeriksa apakah query berhasil dijalankan
        if ($result === false) {
            die("Error: " . $conn->error);
        }

        $dataBarangUser = array();

        if ($result->num_rows > 0) {
            // Output data dari setiap baris
            while ($row = $result->fetch_assoc()) {
                $dataBarangUser[] = array(
                    'id_barang' => $row["id_barang"],
                    'nama_barang' => $row["nama_barang"],
                    'id_admin' => $row["id_admin"],
                    'nama_admin' => $row["nama_admin"],
                    'jumlah_tersedia' => $row["jumlah_tersedia"]
                );
            }
        }
        return $dataBarangUser;
    }
    public function formPeminjaman()
    {
        $nomor_identitas = $_SESSION['nomor_identitas'];
        $nama = $_SESSION['nama'];

        $data['personal'] = [
            'nomor_identitas' => $nomor_identitas,
            'nama' => $nama,
        ];

        $data['dataListBarang'] = isset($_COOKIE['myCookie']) ? $_COOKIE['myCookie'] : null;
        $data['css'] = 'form';

        $this->view("templates/header", $data);
        $this->view("templates/sidebar-user");
        $this->view("user/ajukan-peminjaman/formPeminjaman", $data);
        $this->view("templates/footer");
    }


}
