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
    public function processPinjam()
    {
        $conn = $this->db->getConnection();

        $data_diri = $_POST['formValue'];
        $list_barang = $_POST['dataListBarang'];

        $nama = $data_diri['nama'];
        $nomor_identitas = $data_diri['nomor_identitas'];
        $tgl_peminjaman = $data_diri['startDate'];
        $tgl_pengembalian = $data_diri['endDate'];

        $sql = "INSERT INTO peminjaman (nomor_identitas, tgl_peminjaman, tgl_pengembalian) 
                VALUES (?, STR_TO_DATE(?, '%Y-%m-%d'), STR_TO_DATE(?, '%Y-%m-%d'))";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nomor_identitas, $tgl_peminjaman, $tgl_pengembalian);

        if ($stmt->execute()) {
            $response = ["status" => "success", "message" => "Data berhasil dimasukkan ke dalam tabel peminjaman."];

            $sql = "SELECT id_peminjaman FROM peminjaman WHERE nomor_identitas = ? AND tgl_peminjaman = STR_TO_DATE(?, '%Y-%m-%d') AND tgl_pengembalian = STR_TO_DATE(?, '%Y-%m-%d')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nomor_identitas, $tgl_peminjaman, $tgl_pengembalian);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $id_peminjaman_user = $row['id_peminjaman'];

                $sql = "INSERT INTO detail_peminjaman (id_peminjaman, id_barang, jumlah) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);

                foreach ($list_barang as $barang) {
                    $id_peminjaman = $id_peminjaman_user;
                    $id_barang = $barang['Kode'];
                    $jumlah = $barang['Jumlah Dipinjam'];

                    $stmt->bind_param("sss", $id_peminjaman, $id_barang, $jumlah);
                    $stmt->execute();
                }

                $response['detailStatus'] = "Data barang berhasil dimasukkan ke dalam tabel detail_peminjaman.";
                echo json_encode($response);
            } else {
                echo json_encode(["status" => "error", "message" => "Data tidak ditemukan"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
        }
    }
}
