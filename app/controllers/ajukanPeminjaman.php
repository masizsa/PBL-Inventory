<?php
class AjukanPeminjaman extends Controller
{
    public function index()
    {
        $data['css'] = 'pilih-barang';
        $this->view("templates/header", $data);
        $this->view("templates/sidebar-user");
        $this->view("user/pilih-barang/index");
        $this->view("templates/footer");
    }
}
