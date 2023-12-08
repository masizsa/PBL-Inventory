<?php
class BarangDipinjam extends Controller
{
    public function index()
    {
        $this->view("templates/header");
        $this->view("templates/sidebar-user");
        $this->view("user/barang-dipinjam/index");
        $this->view("templates/footer");
    }
}
