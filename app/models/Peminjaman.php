<?php
class Peminjaman
{
    private $conn;
    private $id_peminjaman;
    private $nomor_identitas;
    private $tgl_peminjaman;
    private $tgl_pengembalian;
    private $status;

    // Konstruktor dengan koneksi database
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Setter
    public function setIdPeminjaman($id_peminjaman)
    {
        $this->id_peminjaman = $id_peminjaman;
    }

    public function setNomorIdentitas($nomor_identitas)
    {
        $this->nomor_identitas = $nomor_identitas;
    }

    public function setTglPeminjaman($tgl_peminjaman)
    {
        $this->tgl_peminjaman = $tgl_peminjaman;
    }

    public function setTglPengembalian($tgl_pengembalian)
    {
        $this->tgl_pengembalian = $tgl_pengembalian;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    // Getter
    public function getIdPeminjaman()
    {
        return $this->id_peminjaman;
    }

    public function getNomorIdentitas()
    {
        return $this->nomor_identitas;
    }

    public function getTglPeminjaman()
    {
        return $this->tgl_peminjaman;
    }

    public function getTglPengembalian()
    {
        return $this->tgl_pengembalian;
    }

    public function getStatus()
    {
        return $this->status;
    }

    // Memasukkan data peminjaman ke dalam database
    public function insertPeminjaman()
    {
        try {
            $sql = "INSERT INTO peminjaman (nomor_identitas, tgl_peminjaman, tgl_pengembalian) 
                        VALUES (?, STR_TO_DATE(?, '%Y-%m-%d'), STR_TO_DATE(?, '%Y-%m-%d'))";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sss", $this->nomor_identitas, $this->tgl_peminjaman, $this->tgl_pengembalian);

            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error: " . $stmt->error);
            }
        } catch (Exception $e) {
            // Tangani kesalahan di sini
            return false;
        }
    }


    // Mendapatkan data peminjaman berdasarkan ID peminjaman
    public function getPeminjamanById($id_peminjaman)
    {
        $sql = "SELECT * FROM peminjaman WHERE id_peminjaman = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id_peminjaman);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id_peminjaman = $row['id_peminjaman'];
            $this->nomor_identitas = $row['nomor_identitas'];
            $this->tgl_peminjaman = $row['tgl_peminjaman'];
            $this->tgl_pengembalian = $row['tgl_pengembalian'];
            $this->status = $row['status'];
        }
    }

    // Metode lain yang mungkin diperlukan
}
