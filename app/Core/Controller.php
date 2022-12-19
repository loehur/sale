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
        if (isset($_SESSION['login_sale'])) {
            if ($_SESSION['login_sale'] == TRUE) {
                $this->userData = $_SESSION['user_data'];
                $this->masterData = $_SESSION['master_data'];
                $this->stafData = $_SESSION['staf_data'];
                $this->setting['toko'] = $_SESSION['setting']['toko'];
                $this->setting['toko_tujuan'] = $_SESSION['setting']['toko_tujuan'];
                $this->listSatuan = $_SESSION['list']['satuan'];
            }
        }
    }

    public function synchrone()
    {
        //USER
        unset($_SESSION['user_data']);
        $where = "id_user = '" . $this->userData['id_user'] . "'";
        $_SESSION['user_data'] = $this->model('Get')->where_row('user', $where);

        //MASTER
        unset($_SESSION['master_data']);
        $where = "id_user = '" . $this->userData['id_master'] . "'";
        $_SESSION['master_data'] = $this->model('Get')->where_row('user', $where);

        //ALL USER ON MASTER
        unset($_SESSION['staf_data']);
        $where = "id_master = '" . $this->userData['id_master'] . "'";
        $_SESSION['staf_data'] = $this->model('Get')->where('user', $where);

        $_SESSION['setting']['toko'] = $this->userData['id_user'];
        $_SESSION['setting']['toko_tujuan'] = "";
        $_SESSION['list']['satuan'] = $this->model('Get')->all('barang_satuan');
    }

    public function synchrone_setting($var, $log)
    {
        $_SESSION['setting'][$var] = $log;
    }
}
