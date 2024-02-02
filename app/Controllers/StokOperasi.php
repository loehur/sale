<?php

class StokOperasi extends Controller
{
   function __construct()
   {
      $this->session()->check();
      $this->data();
      $this->content = __CLASS__ . $this->content;
   }

   function stop_stok()
   {
      $id_barang = $_POST['id'];
      $id_user = $_POST['user'];

      $table = "barang_stok";
      $set = "en = 0";
      $where = "id_master = '" . $this->userData['id_user'] . "' AND id_user = '" . $id_user . "' AND id_barang = '" . $id_barang . "'";
      $do = $this->model('Update')->update($table, $set, $where);
   }
}
