<?php
session_start();
class Login extends Controller
{
    public $isLogin = false;
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    public function index()
    {
        $this->view("templates/header");
        $this->view("user/login/index");
        $this->view("templates/footer");
    }
    public function processLogin()
    {
        $conn = $this->db->getConnection();
        if (isset($_POST["nomor_identitas"])) {
            $nomor_identitas = $_POST["nomor_identitas"];
            $password = md5($_POST["password"]);

            $sql = "SELECT * FROM users WHERE nomor_identitas = \"$nomor_identitas\"";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nomor_identitas = $row["nomor_identitas"];

                if ($row["password"] == $password) {
                    $this->isLogin = true;
                    $_SESSION['nomor_identitas'] = $nomor_identitas;
                    if ($row["status"] == "Admin") {
                        header("Location: ../tambahBarang");
                    } else {
                        header("Location: ../tambahBarang");
                    }
                } else {
                    message('danger', "Login gagal. Password Anda Salah.");
                    header("Location: ../../views/pages/login/login.php");
                }
            } else {
                message('warning', "Username tidak ditemukan.");
                header("Location: ../../views/pages/login/login.php");
            }
        }
    }
}
