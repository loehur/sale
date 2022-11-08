<?php

class Rekap extends Controller
{
   function __construct()
   {
      $this->session()->check();
      $this->data();
      $this->content = __CLASS__ . $this->content;
   }

   function index()
   {
      $this->view_layout(["title" => __CLASS__]);
      $this->view($this->content);
   }

   public function profit()
   {
      if ($this->userData['user_tipe'] <> 1) {
         exit();
      }

      $month = $_POST['y'] . "-" . $_POST['m'];

      $data['data'] = $this->modul("Main")->rekap($month);
      $data['mon'] = array($_POST['y'], $_POST['m']);

      $this->index();
      $this->view(__CLASS__ . "/data", $data);
   }
}
