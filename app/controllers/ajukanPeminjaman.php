<?php
class AjukanPeminjaman extends Controller {
    public function index() {
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('user/ajukan-peminjaman/formPeminjaman');
        $this->view('templates/footer');
    }
}