<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class App
{
    protected $controller = "login";
    protected $method = "index";
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if (isset($_SESSION['isLogin'])) {
            $isAdmin = isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'];

            if ($url[0] === 'login' || $url[0] == '') {
                $this->redirectLoggedInUser($isAdmin);
                return;
            }

            if (!$isAdmin && in_array($url[0], ['dataBarang', 'peminjaman', 'riwayatAdmin', 'ubahSandiAdmin'])) {
                header("Location: ajukanPeminjaman");
                exit();
            }

            // Allow access to all controllers if the user is logged in
            if (!empty($url)) {
                if (file_exists('../app/controllers/' . $url[0] . ".php")) {
                    $this->controller = $url[0];
                    unset($url[0]);
                } else {
                    $this->redirectLoggedInUser($isAdmin);
                }
                require_once '../app/controllers/' . $this->controller . '.php';

                $this->controller = new $this->controller;

                if (isset($url[1])) {
                    $methodName = $url[1];
                    if (method_exists($this->controller, $methodName)) {
                        $this->method = $methodName;
                        unset($url[1]);
                    }
                }

                $this->params = array_values($url);
                call_user_func_array([$this->controller, $this->method], $this->params);
            }
        } else {
            // Limit access to only the login controller if the user is not logged in
            require_once '../app/controllers/login.php';
            $this->controller = new Login();

            if (isset($url[1]) && $url[0] === 'login' && method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }

            $this->params = array_values($url);
            call_user_func_array([$this->controller, $this->method], $this->params);
        }
    }

    public function parseUrl()
    {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        } else {
            return [];
        }
    }

    protected function redirectLoggedInUser($isAdmin)
    {
        // Redirect based on whether the user is an admin or not
        if ($isAdmin) {
            header("Location: dataBarang");
        } else {
            header("Location: ajukanPeminjaman");
        }

        exit();
    }
}
