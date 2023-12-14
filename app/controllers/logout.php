<?php
class Logout extends Controller
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    public function index()
    {
        $data['css'] = 'login';
        $this->view("templates/header", $data);
        $this->view("user/login/index");
        $this->view("templates/footer");
    }
    public function processLogout()
    {
        setcookie("myCookie", "", time() - 3600, "/PBL-Inventory/public");
        // var_dump($_COOKIE['myCookie']);
        session_destroy();
        header("Location: ../");
    }
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
