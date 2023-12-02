<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../../config/connection.php';
include '../../function/message.php';


if (isset($_POST["nomor_identitas"])) {
    $nomor_identitas = $_POST["nomor_identitas"];
    $password = md5($_POST["password"]);

    $sql = "SELECT * FROM users WHERE nomor_identitas = \"$nomor_identitas\"";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["password"] == $password) {
            if ($row["status"] == "admin") {
                echo "ok";
                header("Location: ../../views/admin/home.php");
            } else {
                echo "op";
                header("Location: ../../views/pages/ajukan-peminjaman/index.php");
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
?>