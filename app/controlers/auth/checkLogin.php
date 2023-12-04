<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//Check connection
if ($conn->connect_error) {
    die("Connection failed : " . $conn->connect_error);
}

// include('../../function/message.php');

if (isset($_POST["nomor_identitas"])) {
    $nomor_identitas = $_POST["nomor_identitas"];
    $password = md5($_POST["password"]);

    $sql = "SELECT * FROM users WHERE nomor_identitas = \"$nomor_identitas\"";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nomor_identitass = $row["nomor_identitas"];

        if ($row["password"] == $password) {
            $_SESSION['nomor_identitas'] = $nomor_identitas; // Menyimpan nomor_identitas ke dalam sessi
            if ($row["status"] == "admin") {
                header("Location: ../../views/admin/home.php");
            } else {
                header("Location: ../../views/pages/pemilihan-barang/index.php");
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
