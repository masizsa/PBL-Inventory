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
        if (isset($_POST['data'])) {
            // Read the JSON data from the POST request
            $data = json_decode($_POST['data'], true);

            // Access the array of objects
            $arrayOfObjects = $data;
            $response = ['status' => 'success', 'redirect' => "../ajukanPeminjaman/formPeminjaman"];
            echo json_encode($response);
        } else {
            // Handle the case where 'data' key is not present
            echo json_encode(['error' => 'Data key is not set']);
        }
    }
}
