<?php

class Manual extends Controller
{
   function __construct()
   {
      $this->session()->check();
      $this->data();
   }

   function updateStokAll($id_user)
   {
      $data = $this->model("Get")->cols_where("barang_stok", "id_user, id_barang", "id_user = '" . $id_user . "'");
      foreach ($data as $a) {
         $this->modul("Main")->update_stok_manual($a['id_user'], $a['id_barang']);
      }
   }
}
