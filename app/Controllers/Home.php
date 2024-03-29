<?php

class Home extends Controller
{
   function __construct()
   {
      $this->session()->check();
      $this->data();
      $this->content = __CLASS__ . $this->content;
   }

   function index()
   {

      if (isset($_POST['m'])) {
         $month = $_POST['y'] . "-" . $_POST['m'];
      } else {
         $month = date("Y-m");
      }

      $this->view_layout(["title" => __CLASS__]);
      if ($this->userData['id_user'] == $this->userData['id_master']) {
         exit();
      }
      $data['kas'] = $this->modul('Main')->kas();
      $data['riwayat'] = $this->modul('Main')->riwayat_jual($month);
      $this->view($this->content, $data);
   }

   function setID()
   {
      $this->userData['id_user'] = $_POST['toko'];
      $this->synchrone();
   }
}
