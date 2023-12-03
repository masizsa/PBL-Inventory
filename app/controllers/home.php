<?php
class Home extends Controller
{
    public function index()
    {
        $data['judul'] = 'Home';
        $this->view('templates/header');
        $this->view('home/index');
        $this->view('templates/footer');
    }
}
