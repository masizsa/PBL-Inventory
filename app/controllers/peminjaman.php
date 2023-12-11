<?php
class Peminjaman extends Controller{
    public function index(){
        $data['css'] = 'adminPeminjaman';
        $this->view("templates/header",$data);
        $this->view("templates/sidebar-admin");
        $this->view("admin/peminjaman/index");
        $this->view("templates/footer");
    }
}