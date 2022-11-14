<?php
class Route extends Controller
{

    protected $method = 'index';
    protected $param = [];


    public function __construct()
    {
        session_start();

        if (isset($_GET['url'])) {
            $url = explode('/', filter_var(trim($_GET['url']), FILTER_SANITIZE_URL));
        } else {
            $url[0] = $this->BASE_CONTROLLER;
        }

        if (file_exists('app/Controllers/' . $url[0] . '.php')) {
            date_default_timezone_set("Asia/Jakarta");
            $this->BASE_CONTROLLER = $url[0];
        } else {
            require_once "app/Views/Error/404.php";
            exit();
        }

        require_once 'app/Controllers/' . $this->BASE_CONTROLLER . '.php';
        $this->BASE_CONTROLLER =  new $this->BASE_CONTROLLER;

        if (isset($url[1])) {
            if (method_exists($this->BASE_CONTROLLER, $url[1])) {
                $this->method = $url[1];
            }
        }

        //BUANG URL CONTROLER DAN METHOD UNTUK MENGAMBIL PARAMETER
        unset($url[0]);
        unset($url[1]);
        $this->param = $url;

        //PANGGIL CLASS(yg sudah di panggil init/core beserta fungsi dan parameter)
        call_user_func_array([$this->BASE_CONTROLLER, $this->method], $this->param);
    }
}
