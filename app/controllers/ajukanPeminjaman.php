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

            $result = $conn->query($sql);

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
        $this->view("user/ajukan-peminjaman/index", $data);
        $this->view("templates/footer");
    }
    public function processPinjam()
    {

        $conn = $this->db->getConnection();
        $user = new UserModel($conn);

        $data_diri = $_POST['formValue'];
        $list_barang = $_POST['dataListBarang'];

        $nomor_identitas = $data_diri['nomor_identitas'];
        $tgl_peminjaman = $data_diri['startDate'];
        $tgl_pengembalian = $data_diri['endDate'];

        $user->loadFromDB($nomor_identitas);
        $kesempatan = $user->getKesempatan();

        if ($kesempatan > 0) {
            $peminjaman = new PeminjamanModel($conn);
            $peminjaman->setNomorIdentitas($nomor_identitas);
            $peminjaman->setTglPeminjaman($tgl_peminjaman);
            $peminjaman->setTglPengembalian($tgl_pengembalian);

            if ($peminjaman->insertPeminjaman()) {

                $detailPeminjaman = new DetailPeminjamanModel($conn);
                $result = $detailPeminjaman->getCurrentIdPeminjaman($nomor_identitas, $tgl_peminjaman, $tgl_pengembalian);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $id_peminjaman_user = $row['id_peminjaman'];

                    foreach ($list_barang as $barang) {
                        $id_peminjaman = $id_peminjaman_user;
                        $id_barang = $barang['Kode'];
                        $jumlah = $barang['Jumlah Dipinjam'];

                        $detailPeminjaman->setIdPeminjaman($id_peminjaman);
                        $detailPeminjaman->setIdBarang($id_barang);
                        $detailPeminjaman->setJumlah($jumlah);

                        $detailPeminjaman->insertDetailPeminjaman();
                    }

                    $kesempatan--;
                    $user->setKesempatan($kesempatan);

                    ob_clean();
                    header('Content-Type: application/json');
                    echo json_encode(["status" => "success", 'detailStatus' => "Data barang berhasil dimasukkan ke dalam tabel detail_peminjaman."]);
                } else {
                    ob_clean();
                    header('Content-Type: application/json');
                    echo json_encode(["status" => "error", "message" => "Data tidak ditemukan"]);
                }
            } else {
                ob_clean();
                header('Content-Type: application/json');
                echo json_encode(["status" => "error"]);
            }
        } else {
            ob_clean();
            header('Content-Type: application/json');
            echo json_encode(["status" => "error", "message" => "Error: Kesempatan habis"]);
        }
    }
}
