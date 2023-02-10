<?php

class StokOperasi extends Controller
{
   function __construct()
   {
      $this->session()->check();
      $this->data();
      $this->content = __CLASS__ . $this->content;
   }

   function index($kode_barang = "", $id_user = "")
   {
      $this->view_layout(["title" => __CLASS__]);
      $data = $this->model("Get")->where_row("barang_data", "kode_barang = '" . $kode_barang . "'");
      $data['id_user'] = $id_user;
      $this->data();
      $this->view("SubMenu/stok_operasi", $data);
   }

   function stop_stok($id_barang, $id_user)
   {
      $table = "barang_stok";
      $set = "en = 0";
      $where = "id_master = '" . $this->userData['id_user'] . "' AND id_user = '" . $id_user . "' AND id_barang = '" . $id_barang . "'";

      $do = $this->model('Update')->update($table, $set, $where);
      if ($do['errno'] == 0) {
         header('Location: ' . $this->BASE_URL . "StokData");
      } else {
         print_r($do);
      }
   }
}
