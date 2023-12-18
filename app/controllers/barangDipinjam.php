<?php
class BarangDipinjam extends Controller
{
    public $db;
    public $nomor_identitas;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    public function index()
    {
        $data['datas'] = $this->getData();
        $data['css'] = 'barang-dipinjam';

        $this->view("templates/header", $data);
        $this->view("templates/sidebar-user");
        $this->view("user/barang-dipinjam/index", $data);
        $this->view("templates/footer");
    }

    public function getData()
    {
        if (isset($_SESSION["nomor_identitas"])) {
            $conn = $this->db->getConnection();
            $nomor_identitas = $_SESSION["nomor_identitas"];
            $dataRiwayat = new ViewRiwayat($conn);
            return $dataRiwayat->getDataRiwayatBasedOnId($nomor_identitas);
        }

    }
}
