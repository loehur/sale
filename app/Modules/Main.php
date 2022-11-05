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

   function barang_tunggal($kode_barang)
   {
      return $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_user'] . "' AND kode_barang = '" . $kode_barang . "'");
   }

   function update_stok($id_barang, $rak = "")
   {
      //update stok
      $stok_masuk = $this->model("Sum")->col_where("barang_masuk", "jumlah", "id_user = '" . $this->userData['id_user'] . "' AND id_barang = '" . $id_barang . "' AND op_status = 1");
      $stok_jual = $this->model("Sum")->col_where("barang_jual", "jumlah", "id_user = '" . $this->userData['id_user'] . "' AND id_barang = '" . $id_barang . "' AND op_status = 1");
      $sisa_stok = $stok_masuk - $stok_jual;

      $id_stok = $this->userData['id_user'] . "_" . $id_barang;

      if ($rak <> "") {
         $cols = "id,id_master,id_user,id_barang,stok,rak";
         $vals = "'" . $id_stok . "','" . $this->userData['id_master'] . "','" . $this->userData['id_user'] . "'," . $id_barang . "," . $sisa_stok . ",'" . $rak . "'";
      } else {
         $cols = "id,id_master,id_user,id_barang,stok";
         $vals = "'" . $id_stok . "','" . $this->userData['id_master'] . "','" . $this->userData['id_user'] . "'," . $id_barang . "," . $sisa_stok;
      }

      $update_stok = $this->model("Insert")->cols("barang_stok", $cols, $vals);

      if ($update_stok['errno'] == "1062") {
         if ($rak <> "") {
            $set = "stok = " . $sisa_stok . ", rak = '" . $rak . "'";
         } else {
            $set = "stok = " . $sisa_stok;
         }

         $where = "id = '" . $id_stok . "'";
         $this->model("Update")->update("barang_stok", $set, $where);
      }
   }

   function list_stok()
   {
      $table = "barang_stok";
      $tb_join = "barang_data";
      $on = "barang_stok.id_barang = barang_data.id";
      $where = "barang_stok.id_user = '" . $this->userData['id_user'] . "'";
      return $this->model("Join")->join1_where($table, $tb_join, $on, $where);
   }

   function list_stok_masuk()
   {
      $table = "barang_masuk";
      $tb_join = "barang_data";
      $on = "barang_masuk.id_barang = barang_data.id";
      $where = "barang_masuk.id_user = '" . $this->userData['id_user'] . "' AND barang_masuk.op_status = 0";
      return $this->model("Join")->join1_where($table, $tb_join, $on, $where);
   }

   function list_input_master()
   {
      $table = "barang_data";
      $tb_join = "barang_masuk";
      $on = "barang_masuk.id_barang = barang_data.id";
      $where = "barang_masuk.id_master = '" . $this->userData['id_user'] . "' AND barang_masuk.op_status <> 1 ORDER BY barang_masuk.id DESC";
      return $this->model("Join")->join1_where($table, $tb_join, $on, $where);
   }

   function list_stok_all()
   {
      $table = "barang_stok";
      $tb_join = "barang_data";
      $on = "barang_stok.id_barang = barang_data.id";
      $where = "barang_data.id_master = '" . $this->userData['id_user'] . "'";
      return $this->model("Join")->join1_where($table, $tb_join, $on, $where);
   }

   function id_barang_masuk($id)
   {
      $id_barang = $this->model("Get")->where_row("barang_masuk", "id = " . $id);
      return $id_barang['id_barang'];
   }

   function data_keranjang()
   {
      return $this->model("Get")->where("barang_jual", "id_user = '" . $this->userData['id_user'] . "' AND op_status = 0");
   }

   function kas()
   {
      $kas['total'] = $this->model("Sum")->col_where("barang_jual", "harga_jual", "id_user = '" . $this->userData['id_user'] . "' AND op_status = 1");
      $kas['fee'] = $this->model("Sum")->col_where("barang_jual", "fee", "id_user = '" . $this->userData['id_user'] . "' AND op_status = 1");
      $kas['sup'] = $kas['total'] - $kas['fee'];
      return $kas;
   }

   function riwayat_jual()
   {
      $date = date("Y-m-d");
      $data = [];
      $get = $this->model("Get")->where("barang_jual", "id_user = '" . $this->userData['id_user'] . "' AND op_status = 1 AND updateTime LIKE '%" . $date . "%'");
      foreach ($get as $g) {
         $data[$g['ref']][$g['id']] = $g;
      }
      return $data;
   }
}
