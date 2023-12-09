<?php
session_start();
class Logout extends Controller
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    public function index()
    {
        $this->view("templates/header");
        $this->view("user/login/index");
        $this->view("templates/footer");
    }
    public function processLogout()
    {
        
        session_destroy();
        header("Location: /PBL-Inventory/public/login");
    }
}

error_reporting(E_ALL);
ini_set('display_errors', 1);