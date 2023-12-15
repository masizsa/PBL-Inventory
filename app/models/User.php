<?php

class User
{
    private $conn;

    private $nomor_identitas;
    private $nama;
    private $email;
    private $status;
    private $password;
    private $kesempatan;

    // Constructor untuk menginisialisasi koneksi database
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Getter dan setter untuk setiap properti
    public function getNomorIdentitas()
    {
        return $this->nomor_identitas;
    }

    public function setNomorIdentitas($nomor_identitas)
    {
        $this->nomor_identitas = $nomor_identitas;
        // Panggil metode untuk mengupdate nomor_identitas di database
        $this->updateNomorIdentitasInDB();
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function setNama($nama)
    {
        $this->nama = $nama;
        // Panggil metode untuk mengupdate nama di database
        $this->updateNamaInDB();
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        // Panggil metode untuk mengupdate email di database
        $this->updateEmailInDB();
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        // Panggil metode untuk mengupdate status di database
        $this->updateStatusInDB();
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        // Panggil metode untuk mengupdate password di database
        $this->updatePasswordInDB();
    }

    public function getKesempatan()
    {
        return $this->kesempatan;
    }

    public function setKesempatan($kesempatan)
    {
        $this->kesempatan = $kesempatan;
        // Panggil metode untuk mengupdate kesempatan di database
        $this->updateKesempatanInDB();
    }

    // Metode untuk mengupdate nomor_identitas di database
    private function updateNomorIdentitasInDB()
    {
        $sql = "UPDATE users SET nomor_identitas = ? WHERE nomor_identitas = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->nomor_identitas);
        $stmt->bindParam(2, $this->nomor_identitas);
        $stmt->execute();
    }

    // Metode untuk mengupdate nama di database
    private function updateNamaInDB()
    {
        $sql = "UPDATE users SET nama = ? WHERE nomor_identitas = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->nama);
        $stmt->bindParam(2, $this->nomor_identitas);
        $stmt->execute();
    }

    // Metode untuk mengupdate email di database
    private function updateEmailInDB()
    {
        $sql = "UPDATE users SET email = ? WHERE nomor_identitas = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $this->nomor_identitas);
        $stmt->execute();
    }

    // Metode untuk mengupdate status di database
    private function updateStatusInDB()
    {
        $sql = "UPDATE users SET status = ? WHERE nomor_identitas = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->status);
        $stmt->bindParam(2, $this->nomor_identitas);
        $stmt->execute();
    }

    // Metode untuk mengupdate password di database
    private function updatePasswordInDB()
    {
        $sql = "UPDATE users SET password = ? WHERE nomor_identitas = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->password);
        $stmt->bindParam(2, $this->nomor_identitas);
        $stmt->execute();
    }

    // Metode untuk mengupdate kesempatan di database
    private function updateKesempatanInDB()
    {
        $sql = "UPDATE users SET kesempatan = ? WHERE nomor_identitas = ?";
        $stmt = $this->conn->prepare($sql);

        // Binding parameter
        $stmt->bind_param("is", $this->kesempatan, $this->nomor_identitas);

        // Eksekusi statement
        $stmt->execute();
    }

    // Metode untuk menyimpan data pengguna ke database
    public function saveToDB()
    {
        $sql = "INSERT INTO users (nomor_identitas, nama, email, status, password, kesempatan) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->nomor_identitas);
        $stmt->bindParam(2, $this->nama);
        $stmt->bindParam(3, $this->email);
        $stmt->bindParam(4, $this->status);
        $stmt->bindParam(5, $this->password);
        $stmt->bindParam(6, $this->kesempatan);
        $stmt->execute();
    }

    // Metode untuk mengambil data pengguna dari database berdasarkan nomor_identitas
    public function loadFromDB($nomor_identitas)
    {
        $sql = "SELECT * FROM users WHERE nomor_identitas = ?";
        $stmt = $this->conn->prepare($sql);

        // Binding parameter
        $stmt->bind_param("s", $nomor_identitas);

        // Eksekusi statement
        $stmt->execute();

        // Mengambil hasil query
        $result = $stmt->get_result()->fetch_assoc();

        // Mengisi properti objek dengan data dari database
        if ($result) {
            $this->nomor_identitas = $result['nomor_identitas'];
            $this->nama = $result['nama'];
            $this->email = $result['email'];
            $this->status = $result['status'];
            $this->password = $result['password'];
            $this->kesempatan = $result['kesempatan'];
        }
    }
}
