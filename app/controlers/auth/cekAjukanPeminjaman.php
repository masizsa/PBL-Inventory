<?php 
include_once ('./checkLogin.php');

// echo $nomor_identitas;
//echo $password;
    $sql = "SELECT * FROM users WHERE nomor_identitas = '$nomor_identitas' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Jika data ditemukan, tampilkan dalam formulir
        $row = $result->fetch_assoc();
        $nama = $row['nama'];
        $nomor_identitas = $row['nomor_identitas'];
    } else {
        echo "Data tidak ditemukan!";
    }

$nama = "PUTRI";
$nomor_identitas = "2241720036";
?>