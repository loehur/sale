<?php

class Transaksi extends Controller
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
      $this->keranjang();
      $this->keranjang_pakai();
      $data = $this->modul("Main")->list_stok();
      $this->view($this->content, $data);
   }

   function cek($kode_barang)
   {
      if (strlen($kode_barang) == 0) {
         exit();
      }

      $data = $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_master'] . "' AND kode_barang = '" . $kode_barang . "'");

      if (is_array($data)) {
         if (isset($data['id'])) {
            $id_barang = $data['id'];
            //HITUNG STOK
            $stok = $this->modul("Main")->stok_dikurang_cart($id_barang);
            $this->form_tambah($kode_barang, $stok, $id_barang);
         }
      }
   }

   function keranjang()
   {
      $data = $this->modul("Main")->data_keranjang();
      $this->view(__CLASS__ . "/keranjang", $data);
   }

   function keranjang_pakai()
   {
      $data = $this->modul("Main")->data_keranjang_pakai_user();
      $this->view(__CLASS__ . "/pakai", $data);
   }

   function form_tambah($kode_barang, $stok, $id_barang)
   {
      $data['stok'] = $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_master'] . "' AND kode_barang = '" . $kode_barang . "'");
      $data['sisa'] = $stok;
      $data['sub'] = $this->modul("Main")->list_sub($id_barang);
      $this->view(__CLASS__ . "/form_tambah", $data);
   }

   function cart($id_barang)
   {
      $tambah = $_POST["tambah"];
      if ($tambah < 1) {
         echo "Tidak dapat Order 0";
         exit();
      }
      $d = $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_master'] . "' AND id = '" . $id_barang . "'");

      $desc = $d['merk'] . " " . $d['model'] . " " . $d['deskripsi'];
      $harga = $d['harga'] * $tambah;
      $margin = $d['margin'];
      $margin_rp = $harga * ($margin / 100);
      $fee = $margin_rp * ($this->userData['fee'] / 100);
      $jual = $harga + $margin_rp;

      if (!is_array($d)) {
         print_r($d);
         exit();
      }

      $table = "barang_jual";
      $columns = 'id_master, id_user, id_barang, deskripsi, jumlah, harga, harga_jual, fee, op_status';
      $values = "'" . $this->userData['id_master'] . "','" . $this->userData['id_user'] . "'," . $id_barang . ",'" . $desc . "'," . $tambah . "," . $harga . "," . $jual . "," . $fee . ",0";
      $do = $this->model('Insert')->cols($table, $columns, $values);

      if ($do['errno'] == 0) {
         echo "+" . $tambah . " Keranjang, SUKSES!";
      } else {
         print_r($do);
      }
   }

   function cart_pakai($id_barang)
   {
      $tambah = $_POST["tambah_pakai"];
      if ($tambah < 0.01) {
         echo "Tidak dapat Order 0";
         exit();
      }
      $d = $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_master'] . "' AND id = '" . $id_barang . "'");

      $desc = $d['merk'] . " " . $d['model'] . " " . $d['deskripsi'];
      $harga = $d['harga'] * $tambah;

      if (!is_array($d)) {
         print_r($d);
         exit();
      }

      $table = "barang_pakai";
      $columns = 'id_master, id_user, id_barang, deskripsi, jumlah, harga, op_status';
      $values = "'" . $this->userData['id_master'] . "','" . $this->userData['id_user'] . "'," . $id_barang . ",'" . $desc . "'," . $tambah . "," . $harga . ",0";
      $do = $this->model('Insert')->cols($table, $columns, $values);

      if ($do['errno'] == 0) {
         echo "+" . $tambah . " Pakai, SUKSES!";
      } else {
         print_r($do);
      }
   }

   function cart_sub($id_barang, $id_sub)
   {
      $d = $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_master'] . "' AND id = '" . $id_barang . "'");
      $e = $this->model("Get")->where_row("barang_sub", "id_master = '" . $this->userData['id_master'] . "' AND id = '" . $id_sub . "'");

      $desc = $d['merk'] . " " . $d['model'] . " " . $d['deskripsi'];
      $harga = $d['harga'] * $e['jumlah'];
      $margin = $e['margin'];
      $margin_rp = $harga * ($margin / 100);
      $fee = $margin_rp * ($this->userData['fee'] / 100);
      $jual = $harga + $margin_rp;

      $table = "barang_jual";
      $columns = 'id_master, id_user, id_barang, deskripsi, jumlah, harga, harga_jual, fee, op_status';
      $values = "'" . $this->userData['id_master'] . "','" . $this->userData['id_user'] . "'," . $id_barang . ",'" . $desc . "'," . $e['jumlah'] . "," . $harga . "," . $jual . "," . $fee . ",0";
      $do = $this->model('Insert')->cols($table, $columns, $values);

      if ($do['errno'] == 0) {
         header("location: " . $this->BASE_URL);
      } else {
         print_r($do);
      }
   }

   function hapusCart($id)
   {
      $this->model("Delete")->where("barang_jual", "id =" . $id . " AND op_status = 0");
      $this->index();
   }

   function cekOut()
   {

      $rand = rand(10000, 99999);
      $date = date('Ymd');
      $ref = $date . "-" . $rand;

      $data = $this->modul("Main")->data_keranjang();
      $update = $this->model("Update")->update("barang_jual", "op_status = 1, ref = '" . $ref . "'", "op_status = 0 AND id_user ='" . $this->userData['id_user'] . "'");
      if ($update['errno'] == 0) {
         foreach ($data as $a) {
            $this->modul("Main")->update_stok($a['id_barang']);
         }
         header("location: " . $this->BASE_URL . "Home");
      } else {
         print_r($update);
      }
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
         header("location: " . $this->BASE_URL . "StokPakai");
      } else {
         print_r($update);
      }
   }
}
