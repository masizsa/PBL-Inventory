<?php
class RiwayatUser extends Controller
{
    public function index()
    {
        $this->view("templates/header");
        $this->view("templates/sidebar-user");
        $this->view("user/riwayat/index");
        $this->view("templates/footer");
    }
}
