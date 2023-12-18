<?php
class ViewRiwayat {

    private $conn;
    private $idPeminjaman;
    private $usernamePeminjam;
    private $usernameAdmin;
    private $namaPeminjam;
    private $tglPeminjaman;
    private $tglPengembalian;
    private $idBarang;
    private $namaBarang;
    private $idAdmin;
    private $namaAdmin;
    private $jumlah;
    private $status;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Getter methods
    public function getIdPeminjaman() {
        return $this->idPeminjaman;
    }

    public function getUsernamePeminjam() {
        return $this->usernamePeminjam;
    }

    public function getUsernameAdmin() {
        return $this->usernameAdmin;
    }

    public function getNamaPeminjam() {
        return $this->namaPeminjam;
    }

    public function getTglPeminjaman() {
        return $this->tglPeminjaman;
    }

    public function getTglPengembalian() {
        return $this->tglPengembalian;
    }

    public function getIdBarang() {
        return $this->idBarang;
    }

    public function getNamaBarang() {
        return $this->namaBarang;
    }

    public function getIdAdmin() {
        return $this->idAdmin;
    }

    public function getNamaAdmin() {
        return $this->namaAdmin;
    }

    public function getJumlah() {
        return $this->jumlah;
    }

    public function getStatus() {
        return $this->status;
    }

    // Setter methods
    public function setIdPeminjaman($idPeminjaman) {
        $this->idPeminjaman = $idPeminjaman;
    }

    public function setUsernamePeminjam($usernamePeminjam) {
        $this->usernamePeminjam = $usernamePeminjam;
    }

    public function setUsernameAdmin($usernameAdmin) {
        $this->usernameAdmin = $usernameAdmin;
    }

    public function setNamaPeminjam($namaPeminjam) {
        $this->namaPeminjam = $namaPeminjam;
    }

    public function setTglPeminjaman($tglPeminjaman) {
        $this->tglPeminjaman = $tglPeminjaman;
    }

    public function setTglPengembalian($tglPengembalian) {
        $this->tglPengembalian = $tglPengembalian;
    }

    public function setIdBarang($idBarang) {
        $this->idBarang = $idBarang;
    }

    public function setNamaBarang($namaBarang) {
        $this->namaBarang = $namaBarang;
    }

    public function setIdAdmin($idAdmin) {
        $this->idAdmin = $idAdmin;
    }

    public function setNamaAdmin($namaAdmin) {
        $this->namaAdmin = $namaAdmin;
    }

    public function setJumlah($jumlah) {
        $this->jumlah = $jumlah;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
    public function getDataRiwayatBasedOnId($nomor_identitas) {
        $sql = "SELECT * FROM riwayat WHERE username_peminjam = '$nomor_identitas' AND status != 'Selesai'";
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
    public function getAllDataRiwayat() {
        $sql = "SELECT * FROM tabel_riwayat";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $riwayatArray = array();
            while ($row = $result->fetch_assoc()) {
                $riwayatArray[] = $row;
            }
            return $riwayatArray;
        } else {
            return array();
        }
    }

}
