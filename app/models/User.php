<?php
class User
{
    private $id_barang;
    private $nama_barang;
    private $jumlah_tersedia;
    private $kondisi_barang;
    private $asal;

    // Constructor
    public function __construct($id_barang, $nama_barang, $jumlah_tersedia, $kondisi_barang, $asal)
    {
        $this->id_barang = $id_barang;
        $this->nama_barang = $nama_barang;
        $this->jumlah_tersedia = $jumlah_tersedia;
        $this->kondisi_barang = $kondisi_barang;
        $this->asal = $asal;
    }

    // Getter dan setter untuk id_barang
    public function getIdBarang()
    {
        return $this->id_barang;
    }

    public function setIdBarang($id_barang)
    {
        $this->id_barang = $id_barang;
        // Perbarui nilai di database
        $this->updateDatabase('id_barang', $id_barang);
    }

    // Getter dan setter untuk nama_barang
    public function getNamaBarang()
    {
        return $this->nama_barang;
    }

    public function setNamaBarang($nama_barang)
    {
        $this->nama_barang = $nama_barang;
        // Perbarui nilai di database
        $this->updateDatabase('nama_barang', $nama_barang);
    }

    // Getter dan setter untuk jumlah_tersedia
    public function getJumlahTersedia()
    {
        return $this->jumlah_tersedia;
    }

    public function setJumlahTersedia($jumlah_tersedia)
    {
        $this->jumlah_tersedia = $jumlah_tersedia;
        // Perbarui nilai di database
        $this->updateDatabase('jumlah_tersedia', $jumlah_tersedia);
    }

    // Getter dan setter untuk kondisi_barang
    public function getKondisiBarang()
    {
        return $this->kondisi_barang;
    }

    public function setKondisiBarang($kondisi_barang)
    {
        $this->kondisi_barang = $kondisi_barang;
        // Perbarui nilai di database
        $this->updateDatabase('kondisi_barang', $kondisi_barang);
    }

    // Getter dan setter untuk asal
    public function getAsal()
    {
        return $this->asal;
    }

    public function setAsal($asal)
    {
        $this->asal = $asal;
        // Perbarui nilai di database
        $this->updateDatabase('asal', $asal);
    }

    // Metode untuk menyimpan data barang ke database
    public function save()
    {
        global $conn;

        $query = "INSERT INTO barang (id_barang, nama_barang, jumlah_tersedia, kondisi_barang, asal) VALUES ('$this->id_barang', '$this->nama_barang', '$this->jumlah_tersedia', '$this->kondisi_barang', '$this->asal')";

        if ($conn->query($query) === TRUE) {
            echo "Data barang berhasil disimpan.";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }

    // Metode untuk mengambil data barang dari database
    public static function getById($id_barang)
    {
        global $conn;

        $query = "SELECT * FROM barang WHERE id_barang = '$id_barang'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new User($row['id_barang'], $row['nama_barang'], $row['jumlah_tersedia'], $row['kondisi_barang'], $row['asal']);
        } else {
            return null;
        }
    }

    // Metode untuk memperbarui nilai atribut di database
    private function updateDatabase($field, $value)
    {
        global $conn;

        $query = "UPDATE barang SET $field = '$value' WHERE id_barang = '$this->id_barang'";

        if ($conn->query($query) === FALSE) {
            echo "Error updating database: " . $conn->error;
        }
    }
    public function getDatabaseConnection()
    {
        $databaseInstance = Database::getInstance();
        return $databaseInstance->getConnection();
    }
}
