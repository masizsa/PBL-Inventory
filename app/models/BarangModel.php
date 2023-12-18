<?php
class BarangModel
{
    private $conn;

    private $id_barang;
    private $nama_barang;
    private $id_admin;
    private $jumlah_tersedia;
    private $jumlah_dipinjam;
    private $jml_pemeliharaan;
    private $kondisi_barang;
    private $asal;

    public function __construct($dbConnection)
    {
        // Mengatur koneksi database dari parameter konstruktor
        $this->conn = $dbConnection;
    }


    // Getter dan setter untuk setiap properti
    public function getIdBarang()
    {
        return $this->id_barang;
    }

    public function setIdBarang($id_barang)
    {
        $this->id_barang = $id_barang;
    }

    public function getNamaBarang()
    {
        return $this->nama_barang;
    }

    public function setNamaBarang($nama_barang)
    {
        $this->nama_barang = $nama_barang;
    }

    public function getIdAdmin()
    {
        return $this->id_admin;
    }

    public function setIdAdmin($id_admin)
    {
        $this->id_admin = $id_admin;
    }

    public function getJumlahTersedia()
    {
        return $this->jumlah_tersedia;
    }

    public function setJumlahTersedia($jumlah_tersedia)
    {
        $this->jumlah_tersedia = $jumlah_tersedia;
    }

    public function getJumlahDipinjam()
    {
        return $this->jumlah_dipinjam;
    }

    public function setJumlahDipinjam($jumlah_dipinjam)
    {
        $this->jumlah_dipinjam = $jumlah_dipinjam;
    }

    public function getJmlPemeliharaan()
    {
        return $this->jml_pemeliharaan;
    }

    public function setJmlPemeliharaan($jml_pemeliharaan)
    {
        $this->jml_pemeliharaan = $jml_pemeliharaan;
    }

    public function getKondisiBarang()
    {
        return $this->kondisi_barang;
    }

    public function setKondisiBarang($kondisi_barang)
    {
        $this->kondisi_barang = $kondisi_barang;
    }

    public function getAsal()
    {
        return $this->asal;
    }

    public function setAsal($asal)
    {
        $this->asal = $asal;
    }

    public function getAllBarang()
    {
        $sql = "SELECT * FROM barang";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $barangArray = array();
            while ($row = $result->fetch_assoc()) {
                $barangArray[] = $row;
            }
            return $barangArray;
        } else {
            return array();
        }
    }

    public function getBarangById($id)
    {
        $sql = "SELECT * FROM barang WHERE id_barang = $id";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function addBarang($nama_barang, $id_admin, $jumlah_tersedia, $jumlah_dipinjam, $jml_pemeliharaan, $kondisi_barang, $asal)
    {
        $this->nama_barang = $nama_barang;
        $this->id_admin = $id_admin;
        $this->jumlah_tersedia = $jumlah_tersedia;
        $this->jumlah_dipinjam = $jumlah_dipinjam;
        $this->jml_pemeliharaan = $jml_pemeliharaan;
        $this->kondisi_barang = $kondisi_barang;
        $this->asal = $asal;

        $sql = "INSERT INTO barang (nama_barang, id_admin, jumlah_tersedia, jumlah_dipinjam, jml_pemeliharaan, kondisi_barang, asal) 
                VALUES ('$this->nama_barang', $this->id_admin, $this->jumlah_tersedia, $this->jumlah_dipinjam, $this->jml_pemeliharaan, '$this->kondisi_barang', '$this->asal')";

        if ($this->conn->query($sql) === TRUE) {
            return "Barang berhasil ditambahkan";
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

}
