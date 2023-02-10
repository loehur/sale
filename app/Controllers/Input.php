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

   function barang_edit($kode_barang)
   {
      $data = $this->modul("Main")->barang_tunggal($kode_barang);
      $this->view(__CLASS__ . "/barang_edit", $data);
   }

   function form_tambah($kode_barang)
   {
      $data = $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_master'] . "' AND kode_barang = '" . $kode_barang . "'");
      $data['stok'] = $this->modul("Main")->stok_toko($data['id'], $this->setting['toko']);
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
      $satuan = $_POST["satuan"];

      $table = "barang_data";
      $columns = 'id_master, kode_barang, merk, model, deskripsi, harga, margin, satuan';
      $values = "'" . $this->userData['id_master'] . "','" . $kode_barang . "','" . $merk . "','" . $model . "','" . $deskripsi . "'," . $harga . "," . $margin . "," . $satuan;
      $do = $this->model('Insert')->cols($table, $columns, $values);

      if ($do['errno'] == 0) {
         echo 1;
      } else {
         print_r($do);
      }
   }

   function update_barang($id)
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
      $satuan = $_POST["satuan"];

      $table = "barang_data";
      $set = "kode_barang = '" . $kode_barang . "', merk = '" . $merk . "', model = '" . $model . "', deskripsi = '" . $deskripsi . "', harga = " . $harga . ", margin =" . $margin . ", satuan =" . $satuan;
      $where = "id_master = '" . $this->userData['id_user'] . "' AND id = " . $id;

      $do = $this->model('Update')->update($table, $set, $where);
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

      $op = 0;

      $table = "barang_masuk";
      $columns = 'id_master, id_barang, jumlah, id_user, op_status';
      $values = "'" . $this->userData['id_master'] . "'," . $id_barang . "," . $tambah . ",'" . $this->setting['toko'] . "'," . $op;
      $do = $this->model('Insert')->cols($table, $columns, $values);

      if ($do['errno'] == 0) {
         echo "+" . $tambah . " Stok, SUKSES!";
      } else {
         print_r($do);
      }
   }

   function list_input()
   {
      $data = $this->modul("Main")->list_input_master();
      $this->view(__CLASS__ . "/list_input", $data);
   }

   function hapus_list($id)
   {
      $del = $this->model("Delete")->where("barang_masuk", "id = " . $id . " AND op_status <> 1");
      if ($del['errno'] == 0) {
         $this->index();
      } else {
         print_r($del['error']);
         $this->index();
      }
   }

   function updateLogToko()
   {
      $this->synchrone_setting("toko", $_POST['toko']);
   }

   function updateLogTujuanToko()
   {
      $this->synchrone_setting("toko_tujuan", $_POST['toko']);
   }
}
