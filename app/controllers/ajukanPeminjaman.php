<?php
class AjukanPeminjaman extends Controller
{
    public function index()
    {
        $this->view("templates/header");
        $this->view("templates/sidebar-user");
        $this->view("user/pilih-barang/index");
        $this->view("templates/footer");
    }
}
