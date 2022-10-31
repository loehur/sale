<?php

class TerimaStok extends Controller
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
      $this->view($this->content);
   }

   function cek($kode_barang)
   {
      if (strlen($kode_barang) == 0) {
         exit();
      }

      $data = $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_master'] . "' AND kode_barang = '" . $kode_barang . "'");
      $id_barang = $data['id'];

      $data_ = $this->model("Get")->where("barang_masuk", "id_master = '" . $this->userData['id_master'] . "' AND id_barang = " . $id_barang . " AND id_user = '" . $this->userData['id_user'] . "' AND op_status = 0");
      if (is_array($data_)) {
         $this->cek_terima($data_);
      } else {
         print_r($data_);
      }
   }

   function cek_terima($data)
   {
      foreach ($data as $key => $b) {
         $barang = $this->model("Get")->where_row("barang_data", "id = " . $b['id_barang']);
         $data[$key]['desc'] = $barang['merk'] . " " . $barang['model'] . " " . $barang['deskripsi'];
      }

      $this->view(__CLASS__ . "/cek_masuk", $data);
   }
}
