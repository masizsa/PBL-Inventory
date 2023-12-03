<?php
include ("../core/Database.php");
class Login extends Controller
{
    public $app;
    public $database = 'Database';

    public function index()
    {
        $this->view('templates/header');
        $this->view("login/index");
        $this->view('templates/footer');
    }

    public function processLogin()
    {
        var_dump(file_exists('../core/Database.php'));


        if (isset($_POST["nomor_identitas"])) {
            require_once '../core/Database.php';
            $db = new Database();
            $nomor_identitas = $_POST["nomor_identitas"];
            $password = md5($_POST["password"]);

            $sql = "SELECT * FROM users WHERE nomor_identitas = \"$nomor_identitas\"";
            // $result = $conn->query($sql);
            $result = $db->query($sql);


            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row["password"] == $password) {
                    if ($row["status"] == "admin") {
                        echo "ok";
                        // $_SESSION['isLogin'] = true;
                        // header("Location: app");
                    } else {
                        echo "op";
                        // $_SESSION['isLogin'] = true;
                        // header("Location: app");
                    }
                    // $_SESSION['nomor_identitas'] = $row['nomor_identitas'];
                    // $_SESSION['status'] = $row['status'];
                } else {
                    // Display error message and prevent immediate redirection
                    message('danger', "Login gagal. Password Anda Salah.");
                    header("Location: ../../views/pages/login/login.php");
                }
            } else {
                // Display error message and prevent immediate redirection
                message('warning', "Username tidak ditemukan.");
                header("Location: ../../views/pages/login/login.php");
            }
        }
    }
}
