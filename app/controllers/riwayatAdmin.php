<?php
class RiwayatAdmin extends Controller
{
    public function index()
    {
        $this->view("templates/header");
        $this->view("templates/sidebar-admin");
        $this->view("admin/riwayat/riwayat-admin");
        $this->view("templates/footer");
    }
}
