<?php
class DetailPeminjaman
{
    private $conn;
    private $id_peminjaman;
    private $id_barang;
    private $jumlah;

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

    public function setIdBarang($id_barang)
    {
        $this->id_barang = $id_barang;
    }

    public function setJumlah($jumlah)
    {
        $this->jumlah = $jumlah;
    }

    // Getter
    public function getIdPeminjaman()
    {
        return $this->id_peminjaman;
    }

    public function getIdBarang()
    {
        return $this->id_barang;
    }

    public function getJumlah()
    {
        return $this->jumlah;
    }

    // Memasukkan data detail peminjaman ke dalam database
    public function insertDetailPeminjaman()
    {
        $sql = "INSERT INTO detail_peminjaman (id_peminjaman, id_barang, jumlah) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $this->id_peminjaman, $this->id_barang, $this->jumlah);

        return $stmt->execute();
    }

    // Mendapatkan detail peminjaman berdasarkan ID peminjaman
    public function getDetailPeminjamanById($id_peminjaman)
    {
        $sql = "SELECT * FROM detail_peminjaman WHERE id_peminjaman = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id_peminjaman);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id_peminjaman = $row['id_peminjaman'];
            $this->id_barang = $row['id_barang'];
            $this->jumlah = $row['jumlah'];
        }
    }

    public function getCurrentIdPeminjaman($nomor_identitas, $tgl_peminjaman, $tgl_pengembalian){
        $sql = "SELECT id_peminjaman FROM peminjaman WHERE nomor_identitas = ? AND tgl_peminjaman = STR_TO_DATE(?, '%Y-%m-%d') AND tgl_pengembalian = STR_TO_DATE(?, '%Y-%m-%d')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $nomor_identitas, $tgl_peminjaman, $tgl_pengembalian);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Metode lain yang mungkin diperlukan
}
