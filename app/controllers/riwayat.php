<?php
class Riwayat extends Controller{
    public function index() {
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('user/riwayat/index');
        $this->view('templates/footer');
    }
}