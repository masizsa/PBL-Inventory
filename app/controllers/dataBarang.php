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
        $data['css'] = 'tambah-barang';
        
        $this->view("templates/header", $data);
        $this->view("templates/sidebar-admin");
        $this->view("admin/data-barang/index", $data);
        $this->view("templates/footer");   
    }
    public function getDataBarang()
    {
        $conn = $this->db->getConnection();
        $barang = new BarangModel($conn);

        return $barang->getAllDataBarang();
    }
    public function getNamaAdmin()
    {
        $conn = $this->db->getConnection();
        $user = new UserModel($conn);

        $nomor_identitas = $_SESSION['nomor_identitas'];
        $user->loadFromDB($nomor_identitas);
        return $user->getNama();

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
    
            if (empty($kode_barang) || empty($nama_barang) || empty($asal) || empty($jumlah) || empty($keterangan)) {
                echo json_encode(['status' => 'empty']);
                exit();
            }

            $barang = new BarangModel($conn);
            $stmtCheckIdExist = $barang->getIdBarangById($kode_barang);
            if ($stmtCheckIdExist > 0) {
                echo json_encode(['status' => 'duplicate']);
                exit();
            }
    
            $barang = new BarangModel($conn);
            $resultAdmin = $barang->getIdAdminByUsername($username);
    
            if ($resultAdmin->num_rows > 0) {
                $rowAdmin = $resultAdmin->fetch_assoc();
                $id_admin = $rowAdmin['id_admin'];
    
                $insertQuery = "INSERT INTO barang (id_barang, nama_barang, asal, jumlah_tersedia, kondisi_barang, id_admin, jumlah_dipinjam, jml_pemeliharaan) 
                    VALUES (?, ?, ?, ?, ?, ?, '0', '0')";
    
                $stmtInsert = $conn->prepare($insertQuery);
                $stmtInsert->bind_param("ssssss", $kode_barang, $nama_barang, $asal, $jumlah, $keterangan, $id_admin);
                $stmtInsert->execute();
    
                if ($stmtInsert->affected_rows > 0) {
                    echo json_encode(['status' => 'success']);
                    exit();
                } else {
                    echo json_encode(['status' => 'error']);
                    exit();
                }
            } else {
                echo json_encode(['status' => 'error']);
                exit();
            }
        } else {
            echo "Metode tidak diizinkan.";
        }
    }

    public function deleteBarang($id_barang)
    {
        $conn = $this->db->getConnection();
        
        $referenceCount = 0;
        
        $checkReferenceQuery = "SELECT COUNT(*) FROM detail_peminjaman WHERE id_barang = ?";
        $stmtCheckReference = $conn->prepare($checkReferenceQuery);
        $stmtCheckReference->bind_param("s", $id_barang);
        $stmtCheckReference->execute();
        $stmtCheckReference->bind_result($referenceCount);
        $stmtCheckReference->fetch();
        $stmtCheckReference->close();
        
        if ($referenceCount > 0) {
            // INI KALO ADA YANG MINJEM
            $response = ["status" => "warning", "message" => "Barang dipinjam!"];
            echo json_encode($response);
            exit();
        }
    
        // GAADA YANG DIPINJAM
        $deleteQuery = "DELETE FROM barang WHERE id_barang = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("s", $id_barang);
        $stmt->execute();
        $stmt->close();
    
        // SUKSES WES
        $response = ["status" => "success"];
        echo json_encode($response);
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

    public function updateItem()
    {
        $conn = $this->db->getConnection();
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $kode_barang = $_POST['kode_barang'];
            $nama_barang = $_POST['nama_barang'];
            $asal = $_POST['asal'];
            $jumlah = $_POST['jumlah'];
            $jumlah_pemeliharaan = $_POST['jumlah_pemeliharaan'];
            $keterangan = $_POST['keterangan'];
    
            // Update the item if the check passes
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
                $this->sendJsonResponse(['status' => 'success', 'message' => 'Item updated successfully']);
            } else {
                $this->sendJsonResponse(['status' => 'error', 'message' => 'Failed to update item']);
            }
        } else {
            $this->sendJsonResponse(['status' => 'error', 'message' => 'Invalid request method']);
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
    
        if ($result) {
            $row = $result->fetch_assoc();
            $total_dipinjam = $row['total_dipinjam'] ?? 0;
            $total_tersedia = $row['total_tersedia'] ?? 0;
            $total_pemeliharaan = $row['total_pemeliharaan'] ?? 0;
            $grand_total = $row['grand_total'] ?? 0;
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
