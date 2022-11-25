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
      $stok_transfer = $this->model("Sum")->col_where("barang_masuk", "jumlah", "id_sumber = '" . $this->userData['id_user'] . "' AND id_barang = '" . $id_barang . "' AND op_status <> 2");
      $stok_jual = $this->model("Sum")->col_where("barang_jual", "jumlah", "id_user = '" . $this->userData['id_user'] . "' AND id_barang = '" . $id_barang . "' AND op_status <> 2");
      $stok_pakai = $this->model("Sum")->col_where("barang_pakai", "jumlah", "id_user = '" . $this->userData['id_user'] . "' AND id_barang = '" . $id_barang . "' AND op_status <> 2");
      $sisa_stok = $stok_masuk - $stok_transfer - $stok_jual - $stok_pakai;
      return $sisa_stok;
   }

   function stok_toko($id_barang, $toko)
   {
      $stok_masuk = $this->model("Sum")->col_where("barang_masuk", "jumlah", "id_user = '" . $toko . "' AND id_barang = '" . $id_barang . "' AND op_status = 1");
      $stok_transfer = $this->model("Sum")->col_where("barang_masuk", "jumlah", "id_sumber = '" . $toko . "' AND id_barang = '" . $id_barang . "' AND op_status = 1");
      $stok_jual = $this->model("Sum")->col_where("barang_jual", "jumlah", "id_user = '" . $toko . "' AND id_barang = '" . $id_barang . "' AND op_status = 1");
      $stok_pakai = $this->model("Sum")->col_where("barang_pakai", "jumlah", "id_user = '" . $toko . "' AND id_barang = '" . $id_barang . "' AND op_status = 1");
      $sisa_stok = $stok_masuk - $stok_transfer - $stok_jual - $stok_pakai;

      $stok_masuk_antri = $this->model("Sum")->col_where("barang_masuk", "jumlah", "id_user = '" . $toko . "' AND id_barang = '" . $id_barang . "' AND op_status = 0");
      $stok['sisa'] = $sisa_stok;
      $stok['antri'] = $stok_masuk_antri;
      return $stok;
   }

   function update_stok($id_barang, $rak = "")
   {
      //update stok
      $stok_masuk = $this->model("Sum")->col_where("barang_masuk", "jumlah", "id_user = '" . $this->userData['id_user'] . "' AND id_barang = '" . $id_barang . "' AND op_status = 1");
      $stok_jual = $this->model("Sum")->col_where("barang_jual", "jumlah", "id_user = '" . $this->userData['id_user'] . "' AND id_barang = '" . $id_barang . "' AND op_status = 1");
      $stok_pakai = $this->model("Sum")->col_where("barang_pakai", "jumlah", "id_user = '" . $this->userData['id_user'] . "' AND id_barang = '" . $id_barang . "' AND op_status = 1");
      $sisa_stok = $stok_masuk - $stok_jual - $stok_pakai;

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

   function update_stok_master($id_user, $id_barang, $rak = "")
   {
      //update stok
      $stok_masuk = $this->model("Sum")->col_where("barang_masuk", "jumlah", "id_user = '" . $id_user . "' AND id_barang = '" . $id_barang . "' AND op_status = 1");
      $stok_jual = $this->model("Sum")->col_where("barang_jual", "jumlah", "id_user = '" . $id_user . "' AND id_barang = '" . $id_barang . "' AND op_status = 1");
      $stok_pakai = $this->model("Sum")->col_where("barang_pakai", "jumlah", "id_user = '" . $id_user . "' AND id_barang = '" . $id_barang . "' AND op_status = 1");
      $sisa_stok = $stok_masuk - $stok_jual - $stok_pakai;

      $id_stok = $id_user . "_" . $id_barang;

      if ($rak <> "") {
         $cols = "id,id_master,id_user,id_barang,stok,rak";
         $vals = "'" . $id_stok . "','" . $this->userData['id_master'] . "','" . $id_user . "'," . $id_barang . "," . $sisa_stok . ",'" . $rak . "'";
      } else {
         $cols = "id,id_master,id_user,id_barang,stok";
         $vals = "'" . $id_stok . "','" . $this->userData['id_master'] . "','" . $id_user . "'," . $id_barang . "," . $sisa_stok;
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

   //============================================================================================================================================================//

   function barang_tunggal($kode_barang)
   {
      return $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_user'] . "' AND kode_barang = '" . $kode_barang . "'");
   }

   function sub_tunggal($id_sub)
   {
      return $this->model("Get")->where_row("barang_sub", "id_master = '" . $this->userData['id_user'] . "' AND id = '" . $id_sub . "'");
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
      $table = "barang_data";
      $tb_join = "barang_masuk";
      $on = "barang_masuk.id_barang = barang_data.id";
      $where = "barang_masuk.id_user = '" . $this->userData['id_user'] . "' AND barang_masuk.op_status <> 1 ORDER BY barang_masuk.id DESC";
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
      $where = "barang_data.id_master = '" . $this->userData['id_user'] . "' ORDER BY barang_stok.id_user ASC, barang_stok.stok ASC";
      return $this->model("Join")->join1_where($table, $tb_join, $on, $where);
   }

   function list_sub($id_barang)
   {
      $table = "barang_data";
      $tb_join = "barang_sub";
      $on = "barang_sub.id_barang = barang_data.id";
      $where = "barang_sub.id_master = '" . $this->userData['id_master'] . "' AND barang_sub.id_barang = '" . $id_barang . "'";
      return $this->model("Join")->join1_where($table, $tb_join, $on, $where);
   }

   function list_sub_all()
   {
      $table = "barang_sub";
      $tb_join = "barang_data";
      $on = "barang_sub.id_barang = barang_data.id";
      $where = "barang_sub.id_master = '" . $this->userData['id_user'] . "'";
      return $this->model("Join")->join1_where($table, $tb_join, $on, $where);
   }

   function list_barang()
   {
      $table = "barang_data";
      $where = "id_master = '" . $this->userData['id_user'] . "'";
      return $this->model("Get")->where($table, $where);
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

   function data_keranjang_pakai_master()
   {
      return $this->model("Get")->where("barang_pakai", "id_master = '" . $this->userData['id_user'] . "' AND op_status = 0");
   }

   function data_keranjang_pakai_user()
   {
      return $this->model("Get")->where("barang_pakai", "id_user = '" . $this->userData['id_user'] . "' AND op_status = 0");
   }

   function data_transfer_keluar()
   {
      $table = "barang_data";
      $tb_join = "barang_masuk";
      $on = "barang_masuk.id_barang = barang_data.id";
      $where = "barang_masuk.id_sumber = '" . $this->userData['id_user'] . "' AND barang_masuk.op_status = 0";
      return $this->model("Join")->join1_where($table, $tb_join, $on, $where);
   }

   function kas()
   {
      $totalTarikFee = $this->model("Sum")->col_where("kas", "jumlah", "id_user = '" . $this->userData['id_user'] . "' AND kas_mutasi = 0 AND kas_status <> 2 AND kas_jenis = 1");
      $totalTarikSup = $this->model("Sum")->col_where("kas", "jumlah", "id_user = '" . $this->userData['id_user'] . "' AND kas_mutasi = 0 AND kas_status <> 2 AND kas_jenis = 0");

      $kasJualTotal = $this->model("Sum")->col_where("barang_jual", "harga_jual", "id_user = '" . $this->userData['id_user'] . "' AND op_status = 1");
      $kasFeeTotal = $this->model("Sum")->col_where("barang_jual", "fee", "id_user = '" . $this->userData['id_user'] . "' AND op_status = 1");
      $kasSupTotal = $kasJualTotal - $kasFeeTotal;

      $kas['total'] = $kasJualTotal - $totalTarikFee - $totalTarikSup;
      $kas['fee'] = $kasFeeTotal - $totalTarikFee;
      $kas['sup'] = $kasSupTotal - $totalTarikSup;

      $kas['riwayat'] = $this->model("Get")->where("kas", "id_user = '" . $this->userData['id_user'] . "' ORDER BY id DESC LIMIT 10");
      return $kas;
   }

   function rekap($month)
   {

      $table = "barang_data";
      $tb_join = "barang_jual";
      $on = "barang_jual.id_barang = barang_data.id";
      $where = "barang_data.id_master = '" . $this->userData['id_user'] . "' AND barang_jual.op_status = 1 AND barang_jual.insertTime LIKE '%" . $month . "%'";
      $data['jual'] = $this->model("Join")->join1_where($table, $tb_join, $on, $where);

      $table = "barang_data";
      $tb_join = "barang_pakai";
      $on = "barang_pakai.id_barang = barang_data.id";
      $where = "barang_data.id_master = '" . $this->userData['id_user'] . "' AND barang_pakai.op_status = 1 AND barang_pakai.insertTime LIKE '%" . $month . "%'";
      $data['pakai'] = $this->model("Join")->join1_where($table, $tb_join, $on, $where);

      return $data;
   }

   function riwayat_jual()
   {
      $date = date("Y-m");
      $data = [];

      $table = "barang_data";
      $tb_join = "barang_jual";
      $on = "barang_jual.id_barang = barang_data.id";
      $where = "barang_jual.id_user = '" . $this->userData['id_user'] . "' AND barang_jual.op_status = 1 AND barang_jual.updateTime LIKE '%" . $date . "%' ORDER BY barang_jual.id DESC";
      $get = $this->model("Join")->join1_where($table, $tb_join, $on, $where);

      $no = 0;
      foreach ($get as $g) {
         $data[$g['ref']][$g['id']] = $g;
      }
      return $data;
   }

   function terlaris()
   {
      $bj = $this->model("Get")->cols_where_groubBy_orderBy("barang_jual", "id_barang, id_user, SUM(jumlah) as jumlah", "id_master = '" . $this->userData['id_user'] . "' AND op_status = 1", "id_barang, id_user", "id_user ASC");
      $bp = $this->model("Get")->cols_where_groubBy_orderBy("barang_pakai", "id_barang, id_user, SUM(jumlah) as jumlah", "id_master = '" . $this->userData['id_user'] . "' AND op_status = 1", "id_barang, id_user", "id_user ASC");
      $new = [];

      foreach ($bj as $key => $a) {
         $same = false;
         foreach ($bp as $b) {
            if ($a['id_barang'] == $b['id_barang']) {
               $same = true;
               $a['jumlah'] += $b['jumlah'];
               $new[$key] = $a;
            }
         }
         if ($same == false) {
            $new[$key] = $a;
         }
      }

      return $new;
   }
}
