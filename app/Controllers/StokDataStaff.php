<?php

class StokDataStaff extends Controller
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
      $this->load();
   }

   function load()
   {
      $data['main'] = $this->modul("Main")->list_stok_user($this->userData['id_user']);
      $data['pakai'] = $this->modul("Main")->data_keranjang_pakai_user();
      $this->view($this->content, $data);
   }

   function pakai($id_barang, $tambah)
   {
      $d = $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_master'] . "' AND id = '" . $id_barang . "'");

      $desc = $d['merk'] . " " . $d['model'] . " " . $d['deskripsi'];
      $harga = $d['harga'] * $tambah;

      $table = "barang_pakai";
      $sat = $d['satuan'];
      $columns = 'id_master, id_user, id_barang, deskripsi, jumlah, harga, op_status, satuan';
      $values = "'" . $this->userData['id_master'] . "','" . $this->userData['id_user'] . "'," . $id_barang . ",'" . $desc . "'," . $tambah . "," . $harga . ",0," . $sat;
      $do = $this->model('Insert')->cols($table, $columns, $values);

      if ($do['errno'] == 0) {
         $set = "sort = sort+1";
         $whereSort = "id = " . $id_barang;
         $this->model('Update')->update("barang_data", $set, $whereSort);
      }

      $this->cekOut_pakai();
      $this->load();
   }

   function cekOut_pakai()
   {
      $rand = rand(10000, 99999);
      $date = date('Ymd');
      $ref = $date . "-" . $rand;

      $data = $this->modul("Main")->data_keranjang_pakai_master();
      $update = $this->model("Update")->update("barang_pakai", "op_status = 1, ref = '" . $ref . "'", "op_status = 0 AND id_master ='" . $this->userData['id_user'] . "'");
      if ($update['errno'] == 0) {
         foreach ($data as $a) {
            $this->modul("Main")->update_stok_master($a['id_user'], $a['id_barang']);
         }
      }
   }
}
