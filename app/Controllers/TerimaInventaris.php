<?php

class TerimaInventaris extends Controller
{
   public $table, $table_barang;
   function __construct()
   {
      $this->session()->check();
      $this->data();
      $this->content = __CLASS__ . $this->content;
      $this->table = "barang_inventaris";
      $this->table_barang = "barang_data";
   }

   function index()
   {
      $this->view_layout(["title" => __CLASS__]);
      $data = $this->modul("Main")->list_stok_masuk_inven();
      $this->view($this->content, $data);
   }

   function cek($kode_barang)
   {
      if (strlen($kode_barang) == 0) {
         exit();
      }

      $data = $this->model("Get")->where_row($this->table_barang, "id_master = '" . $this->userData['id_master'] . "' AND kode_barang = '" . $kode_barang . "'");
      if (isset($data['id'])) {
         $id_barang = $data['id'];
      } else {
         exit();
      }


      $data_ = $this->model("Get")->where($this->table, "id_master = '" . $this->userData['id_master'] . "' AND id_barang = " . $id_barang . " AND id_user = '" . $this->userData['id_user'] . "' AND op_status <> 1");
      if (is_array($data_)) {
         $this->cek_terima($data_);
      } else {
         print_r($data_);
      }
   }

   function cek_terima($data)
   {
      foreach ($data as $key => $b) {
         $barang = $this->model("Get")->where_row($this->table_barang, "id = " . $b['id_barang']);
         $data[$key]['desc'] = $barang['merk'] . " " . $barang['model'] . " " . $barang['deskripsi'];
         $data[$key]['satuan'] = $barang['satuan'];
      }

      $this->view(__CLASS__ . "/cek_masuk", $data);
   }

   function terima($terima, $id)
   {
      $where = "id_user = '" . $this->userData['id_user'] . "' AND id = " . $id;
      $set = "op_status = " . $terima;
      $do =  $this->model('Update')->update($this->table, $set, $where);
      if ($do['errno'] == 0) {
         echo $terima;
      } else {
         echo $do['error'];
      }
   }
}
