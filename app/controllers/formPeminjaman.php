<?php
class FormPeminjaman extends Controller
{
    public function index()
    {
        $receivedData = json_decode(file_get_contents("php://input"), true);

        $jsonData = json_encode($receivedData);
        setcookie("myCookie", $jsonData, time() + 3600);
    }
}
