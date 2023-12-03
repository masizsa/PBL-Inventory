<?php
class UbahSandi extends Controller {
    public function index() {
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('user/ubah-sandi/index');
        $this->view('templates/footer');
    }
}