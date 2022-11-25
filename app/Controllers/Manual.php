<?php

class Manual extends Controller
{
   function __construct()
   {
      $this->session()->check();
      $this->data();
   }
   function UpdateStok($id_user)
   {
      $data = $this->model("Get")->where("barang_masuk", "id_user = '" . $id_user . "'");
      foreach ($data as $a) {
         $this->modul("Main")->update_stok_master($a['id_user'], $a['id_barang']);
      }
   }
}
