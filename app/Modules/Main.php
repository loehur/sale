<?php

class Main extends Controller
{
   function __construct()
   {
      $this->session()->check();
      $this->data();
   }

   function stok_dikurang_cart($id_barang)
   {
      $stok_masuk = $this->model("Sum")->col_where("barang_masuk", "jumlah", "id_user = '" . $this->userData['id_user'] . "' AND id_barang = '" . $id_barang . "' AND op_status = 1");
      $stok_jual = $this->model("Sum")->col_where("barang_jual", "jumlah", "id_user = '" . $this->userData['id_user'] . "' AND id_barang = '" . $id_barang . "' AND op_status <> 2");
      $sisa_stok = $stok_masuk - $stok_jual;
      return $sisa_stok;
   }

   function update_stok($id_barang)
   {
      //update stok
      $stok_masuk = $this->model("Sum")->col_where("barang_masuk", "jumlah", "id_user = '" . $this->userData['id_user'] . "' AND id_barang = '" . $id_barang . "' AND op_status = 1");
      $stok_jual = $this->model("Sum")->col_where("barang_jual", "jumlah", "id_user = '" . $this->userData['id_user'] . "' AND id_barang = '" . $id_barang . "' AND op_status = 1");
      $sisa_stok = $stok_masuk - $stok_jual;

      $id_stok = $this->userData['id_user'] . "_" . $id_barang;
      $cols = "id,id_master,id_user,id_barang,stok";
      $vals = "'" . $id_stok . "','" . $this->userData['id_master'] . "','" . $this->userData['id_user'] . "'," . $id_barang . "," . $sisa_stok;
      $update_stok = $this->model("Insert")->cols("barang_stok", $cols, $vals);
      if ($update_stok['errno'] == "1062") {
         $set = "stok = " . $sisa_stok;
         $where = "id = '" . $id_stok . "'";
         $this->model("Update")->update("barang_stok", $set, $where);
      }
   }

   function id_barang_masuk($id)
   {
      $id_barang = $this->model("Get")->where_row("barang_masuk", "id = " . $id);
      return $id_barang['id_barang'];
   }
}
