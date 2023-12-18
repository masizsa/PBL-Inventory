<?php
class ViewDataBarangUser
{
    private $conn;

    private $id_barang;
    private $nama_barang;
    private $id_admin;
    private $nama_admin;
    private $jumlah_tersedia;

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
    public function getNamaAdmin()
    {
        return $this->nama_admin;
    }

    public function setNamaAdmin($nama_admin)
    {
        $this->id_admin = $nama_admin;
    }

    public function getJumlahTersedia()
    {
        return $this->jumlah_tersedia;
    }

    public function setJumlahTersedia($jumlah_tersedia)
    {
        $this->jumlah_tersedia = $jumlah_tersedia;
    }

    

    public function getAllDataBarang()
    {
        $sql = "SELECT * FROM data_barang_user";
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
        $sql = "SELECT * FROM data_barang_user WHERE id_barang = $id";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}
