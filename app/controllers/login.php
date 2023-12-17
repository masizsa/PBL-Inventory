<?php
class Login extends Controller
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    public function index()
    {
        $data['css'] = 'login';
        $this->view("templates/header", $data);
        $this->view("user/login/index");
        $this->view("templates/footer");
    }
    public function processLogin()
    {
        // Mendapatkan koneksi database
        $conn = $this->db->getConnection();

        // Memeriksa kesalahan koneksi database
        if ($conn->connect_error) {
            die('Koneksi database gagal: ' . $conn->connect_error);
        }

        // Memeriksa apakah form telah disubmit
        if (isset($_POST["nomor_identitas"])) {
            // Mengambil nilai dari form
            $nomor_identitas = $_POST["nomor_identitas"];
            $password = md5($_POST["password"]);



            // Menggunakan prepared statement untuk mencegah SQL injection
            $sql = "SELECT * FROM users WHERE nomor_identitas = ? AND password = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $nomor_identitas, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            // Memeriksa hasil kueri
            if ($result->num_rows > 0) {
                $_SESSION["isLogin"] = true;
                $_SESSION["nomor_identitas"] = $nomor_identitas;
                // $_SESSION["password"] = "$password";

                $row = $result->fetch_assoc();
                if ($row["status"] == "Admin") {
                    // Redirect ke halaman admin jika berhasil login
                    $_SESSION["isAdmin"] = true;
                    $_SESSION['nama'] = $row['nama'];
                    header("Location: ../dataBarang");
                    exit();
                } else {
                    // Redirect ke halaman user jika berhasil login
                    $_SESSION['nama'] = $row['nama'];
                    header("Location: ../ajukanPeminjaman");
                    exit();
                }
            } else {
                // Menampilkan pesan kesalahan jika login gagal
                header("Location: ../login");
                message('warning', "Username atau password tidak valid.");
                // Redirect atau menampilkan pesan kesalahan, sesuaikan dengan kebutuhan
                exit();
            }
        } else {
            // Menampilkan pesan kesalahan jika form tidak disubmit
            header("Location: ../login");
            message('warning', "Form login tidak dikirimkan dengan benar.");
            // Redirect atau menampilkan pesan kesalahan, sesuaikan dengan kebutuhan
            exit();
        }
    }
}
