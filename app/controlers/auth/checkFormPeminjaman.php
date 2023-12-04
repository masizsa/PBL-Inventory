<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once ('checkLogin.php');

if(isset($_SESSION['nomor_identitas'])) {
    $nomor_identitas = $_SESSION['nomor_identitas'];
    $sql = "SELECT * FROM users WHERE nomor_identitas = '$nomor_identitas'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Jika data ditemukan, tampilkan dalam formulir
        $row = $result->fetch_assoc();
        $nama = $row['nama'];
    }

} else {
    // echo "Nomor Identitas tidak tersedia";
}


$sql = "SELECT * FROM data_barang ";
$result = $conn->query($sql);    


?>