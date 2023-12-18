<?php
class LoginModel
{
    private $conn;
    private $nomor_identitas;
    private $password;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Getter dan setter untuk nomor_identitas
    public function getNomorIdentitas()
    {
        return $this->nomor_identitas;
    }

    public function setNomorIdentitas($nomor_identitas)
    {
        $this->nomor_identitas = $nomor_identitas;
    }

    // Getter dan setter untuk password
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function loginProcess($nomor_identitas, $password)
    {
        $sql = "SELECT * FROM users WHERE nomor_identitas = ? AND password = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $nomor_identitas, $password);
        $stmt->execute();
        return $stmt->get_result();

    }
}
?>