<?php
include 'database.php';

class User
{
    private $nomor_identitas;
    private $nama;
    private $email;
    private $status;
    private $password;

    // Constructor
    public function __construct($nomor_identitas, $nama, $email, $status, $password)
    {
        $this->nomor_identitas = $nomor_identitas;
        $this->nama = $nama;
        $this->email = $email;
        $this->status = $status;
        $this->password = $password;
    }

    // Getter dan setter untuk nomor_identitas
    public function getNomorIdentitas()
    {
        return $this->nomor_identitas;
    }

    public function setNomorIdentitas($nomor_identitas)
    {
        $this->nomor_identitas = $nomor_identitas;
        // Perbarui nilai di database
        $this->updateDatabase('nomor_identitas', $nomor_identitas);
    }

    // Getter dan setter untuk nama
    public function getNama()
    {
        return $this->nama;
    }

    public function setNama($nama)
    {
        $this->nama = $nama;
        // Perbarui nilai di database
        $this->updateDatabase('nama', $nama);
    }

    // Getter dan setter untuk email
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        // Perbarui nilai di database
        $this->updateDatabase('email', $email);
    }

    // Getter dan setter untuk status
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        // Perbarui nilai di database
        $this->updateDatabase('status', $status);
    }

    // Getter dan setter untuk password
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        // Perbarui nilai di database
        $this->updateDatabase('password', $password);
    }

    // Metode untuk menyimpan data pengguna ke database
    public function save()
    {
        global $conn;

        $query = "INSERT INTO users (nomor_identitas, nama, email, status, password) VALUES ('$this->nomor_identitas', '$this->nama', '$this->email', '$this->status', '$this->password')";

        if ($conn->query($query) === TRUE) {
            echo "Data pengguna berhasil disimpan.";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }

    // Metode untuk mengambil data pengguna dari database
    public static function getById($nomor_identitas)
    {
        global $conn;

        $query = "SELECT * FROM users WHERE nomor_identitas = '$nomor_identitas'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new User($row['nomor_identitas'], $row['nama'], $row['email'], $row['status'], $row['password']);
        } else {
            return null;
        }
    }

    // Metode untuk memperbarui nilai atribut di database
    private function updateDatabase($field, $value)
    {
        global $conn;

        $query = "UPDATE users SET $field = '$value' WHERE nomor_identitas = '$this->nomor_identitas'";

        if ($conn->query($query) === FALSE) {
            echo "Error updating database: " . $conn->error;
        }
    }
}
