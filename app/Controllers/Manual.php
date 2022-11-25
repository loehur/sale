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
      $this->model("Delete")->where("barang_stok", "id_user = '" . $id_user . "'");
      
      $data = $this->model("Get")->cols_where_groubBy("barang_masuk", "id_user, id_barang", "id_user = '" . $id_user . "'", "id_user, id_barang");

      foreach ($data as $a) {
         $this->modul("Main")->update_stok_master($a['id_user'], $a['id_barang']);
      }

      $data2 = $this->model("Get")->cols_where_groubBy("barang_pakai", "id_user, id_barang", "id_user = '" . $id_user . "'", "id_user, id_barang");

      foreach ($data2 as $a) {
         $this->modul("Main")->update_stok_master($a['id_user'], $a['id_barang']);
      }
   }
}
