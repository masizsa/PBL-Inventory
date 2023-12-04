<?php
class Login extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view("login/index");
        $this->view('templates/footer');
    }

    public function processLogin()
    {
        $db = Database::getInstance()->getConnection();

        if (isset($_POST["nomor_identitas"])) {
            $nomor_identitas = $_POST["nomor_identitas"];
            $password = md5($_POST["password"]);

            $sql = "SELECT * FROM users WHERE nomor_identitas = \"$nomor_identitas\"";
            $result = $db->query($sql);


            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row["password"] == $password) {
                    if ($row["status"] == "Admin") {
                        echo "ok";
                    } else {
                        $this->view('templates/header');
                        $this->view('templates/sidebar');
                        $this->view('public/user/riwayat/index');
                        $this->view('templates/footer');
                    }
                } else {
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
