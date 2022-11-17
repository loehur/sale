<?php

class StokPakai extends Controller
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
      $data = $this->modul("Main")->data_pakai();
      $this->view($this->content, $data);
   }

   function hapusCart($id)
   {
      $this->model("Delete")->where("barang_jual", "id =" . $id . " AND op_status = 0");
      $this->index();
   }
}
