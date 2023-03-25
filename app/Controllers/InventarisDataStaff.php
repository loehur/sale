<?php

class InventarisDataStaff extends Controller
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
      $stok = $this->modul("Main")->list_stok_user_inven($this->userData['id_user']);
      $this->view($this->content, $stok);
   }
}
