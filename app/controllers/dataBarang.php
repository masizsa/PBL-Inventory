<?php
class DataBarang extends Controller
{
    public $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    public function index()
    {
        $data = array();
        $data['nama'] = $this->getNamaAdmin();
        $data['barang'] = $this->getDataBarang();
        $data['summaryData'] = $this->getSummaryData();
        // var_dump($data['summaryData']);
        $data['css'] = 'tambah-barang';
        $this->view("templates/header", $data);
        $this->view("templates/sidebar-admin");
        $this->view("admin/data-barang/index", $data);
        $this->view("templates/footer");   
    }
    public function getDataBarang()
    {
        $conn = $this->db->getConnection();
        $query = "SELECT * FROM barang";

        $result_set = $conn->query($query);

        $result = array();
        if ($result_set->num_rows > 0) {
            // Memasukkan hasil query ke dalam array
            while ($row = $result_set->fetch_assoc()) {
                array_push($result, $row);
            }
        }
        return $result;
    }
    public function getNamaAdmin()
    {
        $conn = $this->db->getConnection();
        $nomor_identitas = $_SESSION['nomor_identitas'];
        $query = "SELECT nama FROM users WHERE nomor_identitas = $nomor_identitas";

        $result_set = $conn->query($query);

        $result = "";
        if ($result_set->num_rows > 0) {
            // Memasukkan hasil query ke dalam array
            while ($row = $result_set->fetch_assoc()) {
                $result = $row['nama'];
            }
        }
        return $result;
    }
    public function addBarang()
    {
        $conn = $this->db->getConnection();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_SESSION['nomor_identitas'];
            $kode_barang = $_POST['kode_barang'];
            $nama_barang = $_POST['nama_barang'];
            $asal = $_POST['asal'];
            $jumlah = $_POST['jumlah'];
            $keterangan = $_POST['keterangan'];

            // Check if any form input is empty
            if (empty($kode_barang) || empty($nama_barang) || empty($asal) || empty($jumlah) || empty($keterangan)) {
                echo "<script>";
                echo "alert('Warning: Please fill in all the form fields.');";
                echo "window.location.href = '../../public/dataBarang';";
                echo "</script>";
                exit();
            }

            // Check if id_barang already exists
            $checkIdExistQuery = "SELECT id_barang FROM barang WHERE id_barang = '$kode_barang'";
            $resultExist = $conn->query($checkIdExistQuery);

            if ($resultExist->num_rows > 0) {
                echo "<script>";
                echo "alert('Warning: id_barang $kode_barang already exists in the database.');";
                echo "window.location.href = '../../public/dataBarang';";
                echo "</script>";
                exit();
            }

            // Query to get id_admin based on username
            $getIdAdminQuery = "SELECT id_admin FROM admin WHERE username_admin = '$username'";
            $result = $conn->query($getIdAdminQuery);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $id_admin = $row['id_admin'];

                $query = "INSERT INTO barang (id_barang, nama_barang, asal, jumlah_tersedia, kondisi_barang, id_admin, jumlah_dipinjam, jml_pemeliharaan) 
                VALUES ('$kode_barang', '$nama_barang', '$asal', '$jumlah', '$keterangan', '$id_admin', '0', '0')";

                $conn->query($query)
                or die($conn->error);
                header("Location: ../../public/dataBarang");
                exit();
            } else {
                echo "Error: Unable to retrieve id_admin.";
            }
        } else {
            echo "Metode tidak diizinkan.";
        }
    }
    public function deleteBarang($id_barang)
    {
        $conn = $this->db->getConnection();
        // Use prepared statements to prevent SQL injection
        $deleteQuery = "DELETE FROM barang WHERE id_barang = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("s", $id_barang);
        $stmt->execute();
        header("Location: ../../dataBarang");
        exit();
    }
    private function sendJsonResponse($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
    public function getBarangDetails($id_barang)
    {
        $conn = $this->db->getConnection();

        $query = "SELECT * FROM barang WHERE id_barang = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id_barang);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->sendJsonResponse($row);
        } else {
            $this->sendJsonResponse(["error" => "Item not found"]);
        }
    }
    public function getItemDetails($id_barang)
    {
        $conn = $this->db->getConnection();

        $query = "SELECT * FROM barang WHERE id_barang = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id_barang);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $itemDetails = $result->fetch_assoc();
            $this->sendJsonResponse($itemDetails);
        } else {
            http_response_code(404);
            $this->sendJsonResponse(['error' => 'Item not found']);
        }
    }
    public function updateItem()
    {
        $conn = $this->db->getConnection();
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Assuming you are using POST parameters, adjust accordingly
            $kode_barang = $_POST['kode_barang'];
            $nama_barang = $_POST['nama_barang'];
            $asal = $_POST['asal'];
            $jumlah = $_POST['jumlah'];
            $jumlah_pemeliharaan = $_POST['jumlah_pemeliharaan'];
            $keterangan = $_POST['keterangan'];
    
            $updateQuery = "UPDATE barang SET 
                nama_barang = ?, 
                asal = ?, 
                jumlah_tersedia = ?, 
                jml_pemeliharaan = ?, 
                kondisi_barang = ? 
                WHERE id_barang = ?";
    
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("ssisss", $nama_barang, $asal, $jumlah, $jumlah_pemeliharaan, $keterangan, $kode_barang);
            $stmt->execute();
    
            if ($stmt->affected_rows > 0) {
                $this->sendJsonResponse(['success' => 'Item updated successfully']);
            } else {
                $this->sendJsonResponse(['error' => 'Failed to update item']);
            }
        } else {
            $this->sendJsonResponse(['error' => 'Invalid request method']);
        }
    }    
    public function getSummaryData()
    {
        $conn = $this->db->getConnection();
    
        $query = "SELECT 
                    SUM(jumlah_dipinjam) AS total_dipinjam,
                    SUM(jumlah_tersedia) AS total_tersedia,
                    SUM(jml_pemeliharaan) AS total_pemeliharaan,
                    SUM(jumlah_dipinjam + jumlah_tersedia + jml_pemeliharaan) AS grand_total
                FROM barang";
    
        $result = $conn->query($query);
        // var_dump($result);
    
        if ($result) {
            $row = $result->fetch_assoc();
            // var_dump($row);
            // Handle null values to avoid issues in the view
            $total_dipinjam = $row['total_dipinjam'] ?? 0;
            $total_tersedia = $row['total_tersedia'] ?? 0;
            $total_pemeliharaan = $row['total_pemeliharaan'] ?? 0;
            $grand_total = $row['grand_total'] ?? 0;
            // var_dump($total_dipinjam);
            return [
                'total_dipinjam' => $total_dipinjam,
                'total_tersedia' => $total_tersedia,
                'total_pemeliharaan' => $total_pemeliharaan,
                'grand_total' => $grand_total,
            ];
        } else {
            // Handle the case where the query fails
            return [
                'total_dipinjam' => 0,
                'total_tersedia' => 0,
                'total_pemeliharaan' => 0,
                'grand_total' => 0,
            ];
        }
    }
}
