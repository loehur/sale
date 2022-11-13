<?php

class StokSub extends Controller
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
      $data = $this->modul("Main")->list_barang();
      $this->view($this->content, $data);
   }

   function cek($kode_barang)
   {
      if (strlen($kode_barang) == 0) {
         exit();
      }

      $data = $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_master'] . "' AND kode_barang = '" . $kode_barang . "'");
      if (is_array($data)) {
         if (isset($data['kode_barang'])) {
            $this->form_tambah($kode_barang);
         }
      }
   }

   function form_tambah($kode_barang)
   {
      $data = $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_master'] . "' AND kode_barang = '" . $kode_barang . "'");
      $data['list_sub'] = $this->modul("Main")->list_sub($data['id']);
      $this->view(__CLASS__ . "/form_tambah", $data);
   }

   
   function tambah_sub($id_barang)
   {
      if ($this->userData['user_tipe'] <> 1) {
         echo "Forbidden Access";
         exit();
      }

      $jumlah = $_POST["jumlah"];
      $margin = $_POST["margin"];


      $table = "barang_sub";
      $columns = 'id, id_master, id_barang, jumlah, margin';
      $values = "'" . $id_barang . $jumlah . "','" . $this->userData['id_master'] . "','" . $id_barang . "'," . $jumlah . "," . $margin;
      $do = $this->model('Insert')->cols($table, $columns, $values);

      if ($do['errno'] == 0) {
         echo "+ Sub, SUKSES!";
      } else {
         print_r($do);
      }
   }
}
