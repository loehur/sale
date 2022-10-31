<?php

require_once 'app/Config/Variables.php';

class Controller extends Variables
{

    public function view_layout($data = [])
    {
        require_once "app/Views/Layout/layout_main.php";
        require_once "app/Views/Layout/nav_bot.php";
    }

    public function view($file, $data = [])
    {
        require_once "app/Views/" . $file . ".php";
    }

    public function model($file)
    {
        require_once "app/Models/" . $file . ".php";
        return new $file();
    }

    public function function($file)
    {
        require_once "app/Functions/" . $file . ".php";
        return new $file();
    }

    public function curl($file)
    {
        require_once "app/Curls/" . $file . ".php";
        return new $file();
    }

    public function modul($file)
    {
        require_once "app/Modules/" . $file . ".php";
        return new $file();
    }


    public function session()
    {
        require_once "app/Functions/Session.php";
        return new Session();
    }

    public function data()
    {
        $this->userData = $_SESSION['user_data'];
        $this->masterData = $_SESSION['master_data'];
        $this->stafData = $_SESSION['staf_data'];
        $this->log['toko'] = $_SESSION['log']['toko'];
    }

    public function synchrone()
    {
        unset($_SESSION['user_data']);
        //MASTER
        $where = "id_user = " . $this->userData['id_master'];
        $_SESSION['master_data'] = $this->model('Get')->where_row('user', $where);

        unset($_SESSION['master_data']);
        //MASTER
        $where = "id_master = " . $this->userData['id_master'];
        $_SESSION['staf_data'] = $this->model('Get')->where('user', $where);

        $_SESSION['log']['toko'] = $this->userData['id_user'];
    }

    public function synchrone_non_db($log_toko)
    {
        $_SESSION['log']['toko'] = $log_toko;
    }
}
