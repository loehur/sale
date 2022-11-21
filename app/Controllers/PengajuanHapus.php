<?php

class PengajuanHapus extends Controller
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
      $data = $this->model("Get")->where("barang_jual", "id_master = '" . $this->userData['id_master'] . "' AND id_user = '" . $this->userData['id_user'] . "' AND op_status = 1 AND bin = 1");
      $this->view($this->content, $data);
   }

   function cek($kode_barang)
   {
      if (strlen($kode_barang) == 0) {
         exit();
      }

      $data_ = $this->model("Get")->where("barang_jual", "id_master = '" . $this->userData['id_master'] . "' AND id = " . $kode_barang . " AND id_user = '" . $this->userData['id_user'] . "' AND op_status = 1");
      if (!isset($data_['errno'])) {
         $this->cek_terima($data_);
      }
   }

   function cek_terima($data)
   {
      $this->view(__CLASS__ . "/cek_masuk", $data);
   }

   function list_master()
   {
      $this->view_layout(["title" => __CLASS__]);
      $data = $this->model("Get")->where("barang_jual", "id_master = '" . $this->userData['id_master'] . "' AND op_status = 1 AND bin = 1");
      $this->view(__CLASS__ . "/cek_masuk_master", $data);
   }

   function hapusJual($id)
   {
      $where = "id_user = '" . $this->userData['id_user'] . "' AND id = " . $id;
      $set = "bin = 1";
      $do =  $this->model('Update')->update("barang_jual", $set, $where);
      if ($do['errno'] == 0) {
         echo 1;
      } else {
         echo $do['error'];
      }
   }

   function tolakHapus($id)
   {
      $where = "id_master = '" . $this->userData['id_user'] . "' AND id = " . $id;
      $set = "bin = 0";
      $do =  $this->model('Update')->update("barang_jual", $set, $where);
      if ($do['errno'] == 0) {
         $this->list_master();
      } else {
         echo $do['error'];
      }
   }

   function hapusSemua()
   {
      $data = $this->model("Get")->where("barang_jual", "id_master = '" . $this->userData['id_master'] . "' AND op_status = 1 AND bin = 1");

      $where = "id_master = '" . $this->userData['id_user'] . "' AND bin = 1";
      $do =  $this->model('Delete')->where("barang_jual", $where);
      if ($do['errno'] == 0) {
         foreach ($data as $a) {
            $this->modul("Main")->update_stok_master($a['id_user'], $a['id_barang']);
         }
         $this->list_master();
      } else {
         echo $do['error'];
      }
   }
}
