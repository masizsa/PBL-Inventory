<?php
// Proses penambahan data barang
include('../controlers/auth/checkFormPeminjaman.php');
echo "ok";
$dataBarang = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lakukan operasi penambahan barang di sini
    // Misalnya, tambahkan barang ke dalam database
    // Simpan data barang yang ditambahkan ke dalam variabel $dataBarang
    $kodeBarang = $_POST["id"];
    
    $dataBarang = array(
        "id_barang" => $kodeBarang
        // ,"nama_barang" => $namaBarang
    );

    // Kembalikan data barang yang ditambahkan sebagai respon
    echo json_encode($dataBarang);
    exit;
}
?>
