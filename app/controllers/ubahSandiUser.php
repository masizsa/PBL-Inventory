<?php
class UbahSandiUser extends Controller
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    public function index()
    {
        $data['css'] = 'ubahSandi';
        $this->view("templates/header", $data);
        $this->view("templates/sidebar-user");
        $this->view("user/ubah-sandi/index");
        $this->view("templates/footer");
    }

    public function ubahSandiProccess()
    {
        $nomor_identitas = $_SESSION['nomor_identitas'];

        $conn = $this->db->getConnection();
        $user = new UserModel($conn);
        $user->loadFromDB($nomor_identitas);
        // $confirmCurrentPassword = $_SESSION['password'];
        $confirmCurrentPassword = $user->getPassword();

        $currentPassword = md5($_POST['sandi_sekarang']);

        $newPassword = $_POST['sandi_baru'];
        $confirmPassword = $_POST['konfirmasi_sandi'];

        if ($confirmCurrentPassword === $currentPassword) {
            if (strlen($newPassword) >= 8 && strlen($newPassword) <= 12) {
                if ($newPassword === $confirmPassword) {
                    $newPassword = md5($_POST['sandi_baru']);
                    $confirmPassword = md5($_POST['konfirmasi_sandi']);
                    $result = $user->setPassword($confirmPassword);

                    if ($result) {
                        echo json_encode(['status' => 'success']);
                    } else {
                        echo json_encode(['status' => 'error']);
                    }
                } else {
                    echo json_encode(['status' => 'password_mismatch']);
                }
            } else {
                echo json_encode(['status' => 'password_invalid']);
            }
        } else {
            echo json_encode(['status' => 'error', 'data' => "$confirmCurrentPassword , $currentPassword"]);
        }
    }
}
