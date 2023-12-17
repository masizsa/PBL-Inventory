<?php

class UserModel
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
        $this->updateFieldInDB("nomor_identitas", $nomor_identitas);
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function setNama($nama)
    {
        $this->nama = $nama;
        $this->updateFieldInDB("nama", $nama);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        $this->updateFieldInDB("email", $email);
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->updateFieldInDB("status", $status);
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this->updateFieldInDB("password", $password);
    }

    public function getKesempatan()
    {
        return $this->kesempatan;
    }

    public function setKesempatan($kesempatan)
    {
        $this->kesempatan = $kesempatan;
        $this->updateFieldInDB("kesempatan", $kesempatan);
    }

    // Metode umum untuk mengupdate kolom tertentu di database
    private function updateFieldInDB($field, $value)
    {
        $sql = "UPDATE users SET $field = ? WHERE nomor_identitas = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $value, $this->nomor_identitas);
        return $stmt->execute();
    }

    // Metode untuk menyimpan data pengguna ke database
    public function saveToDB()
    {
        $sql = "INSERT INTO users (nomor_identitas, nama, email, status, password, kesempatan) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssi", $this->nomor_identitas, $this->nama, $this->email, $this->status, $this->password, $this->kesempatan);
        $stmt->execute();
    }

    // Metode untuk mengambil data pengguna dari database berdasarkan nomor_identitas
    public function loadFromDB($nomor_identitas)
    {
        $sql = "SELECT * FROM users WHERE nomor_identitas = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $nomor_identitas);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

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
