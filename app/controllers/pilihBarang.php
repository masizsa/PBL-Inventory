<?php
class PilihBarang extends Controller
{
    public function index()
    {
        $this->view("templates/header");
        $this->view("templates/sidebar-admin");
        $this->view("user/pilih-barang/index");
        $this->view("templates/footer");
    }
}
