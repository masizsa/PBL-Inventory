<?php
session_start();
class Login extends Controller {
    public $isLogin = false;
    public function index() {
        $this->view("user/login/index");
    }
}