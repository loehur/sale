<?php

class Input extends Controller
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
      if (is_array($data)) {
         if (isset($data['kode_barang'])) {
            $this->form_tambah($kode_barang);
         } else {
            $this->barang_baru($kode_barang);
         }
      } else {
         $this->barang_baru($kode_barang);
      }
   }

   function barang_baru($kode_barang)
   {
      $this->view(__CLASS__ . "/barang", $kode_barang);
   }

   function form_tambah($kode_barang)
   {
      $data = $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_master'] . "' AND kode_barang = '" . $kode_barang . "'");
      $this->view(__CLASS__ . "/form_tambah", $data);
   }

   function simpan_barang_baru()
   {
      if ($this->userData['user_tipe'] <> 1) {
         echo "Forbidden Access";
         exit();
      }

      $kode_barang = $_POST["kode_barang"];
      $merk = $_POST["merk"];
      $model = $_POST["model"];
      $deskripsi = $_POST["deskripsi"];
      $harga = $_POST["harga"];
      $margin = $_POST["margin"];

      $table = "barang_data";
      $columns = 'id_master, kode_barang, merk, model, deskripsi, harga, margin';
      $values = "'" . $this->userData['id_master'] . "','" . $kode_barang . "','" . $merk . "','" . $model . "','" . $deskripsi . "'," . $harga . "," . $margin;
      $do = $this->model('Insert')->cols($table, $columns, $values);

      if ($do['errno'] == 0) {
         echo 1;
      } else {
         print_r($do);
      }
   }

   function tambah_stok($id_barang)
   {
      if ($this->userData['user_tipe'] <> 1) {
         echo "Forbidden Access";
         exit();
      }

      $tambah = $_POST["tambah"];
      $table = "barang_masuk";
      $columns = 'id_master, id_barang, jumlah, id_user';
      $values = "'" . $this->userData['id_master'] . "'," . $id_barang . "," . $tambah . ",'" . $this->log['toko'] . "'";
      $do = $this->model('Insert')->cols($table, $columns, $values);

      if ($do['errno'] == 0) {
         echo "+" . $tambah . " Stok, SUKSES!";
      } else {
         print_r($do);
      }
   }

   function updateLogToko()
   {
      $id_user = $_POST['toko'];
      $this->synchrone_non_db($id_user);
   }
}
