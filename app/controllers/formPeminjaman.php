<?php
class Peminjaman extends Controller
{
    public function index()
    {
        $this->view("templates/header");
        $this->view("templates/sidebar-admin");
        $this->view("user/ajukan-peminjaman/index");
        $this->view("templates/footer");
    }
}
