<?php

class StokPengganti extends Controller
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
      $data = $this->modul("Main")->list_stok_all();
      $this->view($this->content, $data);
   }

   function cek($kode_barang, $id_user)
   {
      if (strlen($kode_barang) == 0) {
         exit();
      }

      $barang = $this->model("Get")->where_row("barang_data", "kode_barang = '" . $kode_barang . "'");
      $id_barang = $barang['id'];

      $data = $this->model("Get")->where_row("barang_stok", "id_master = '" . $this->userData['id_master'] . "' AND id_user = '" . $id_user . "' AND id_barang = '" . $id_barang . "'");

      if (is_array($data) & isset($data['pengganti'])) {
         $id_pengganti = $data['pengganti'];
         $pengganti = $this->model("Get")->where_row("barang_data", "id = '" . $id_pengganti . "'");
      }

      if (isset($pengganti) && is_array($pengganti)) {
         $data['nama_barang'] = $barang['merk'] . " " . $barang['model'] . " " . $barang['deskripsi'];
         $data['pengganti'] = $pengganti['merk'] . " " . $pengganti['model'] . " " . $pengganti['deskripsi'];
         $this->view(__CLASS__ . "/data", $data);
      }
   }

   function ganti()
   {
      $id_user = $_POST["toko"];

      $kode_barang = $_POST["kode_barang"];
      $id_barang = $this->model("Get")->where_row("barang_data", "kode_barang = '" . $kode_barang . "'")['id'];

      $kode_barang_r = $_POST["kode_barang_r"];

      $id_barang_r = $this->model("Get")->where_row("barang_data", "kode_barang = '" . $kode_barang_r . "'")['id'];

      $table = "barang_stok";
      $set = "pengganti = '" . $id_barang_r . "'";
      $where = "id_master = '" . $this->userData['id_user'] . "' AND id_user = '" . $id_user . "' AND id_barang = '" . $id_barang . "'";

      $do = $this->model('Update')->update($table, $set, $where);
      if ($do['errno'] == 0) {
         echo 1;
      } else {
         print_r($do);
      }
   }
}
