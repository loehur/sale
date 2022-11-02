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
            $this->form_tambah($kode_barang, $stok);
         }
      }
   }

   function keranjang()
   {
      $data = $this->modul("Main")->data_keranjang();
      $this->view(__CLASS__ . "/keranjang", $data);
   }

   function form_tambah($kode_barang, $stok)
   {
      $data = $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_master'] . "' AND kode_barang = '" . $kode_barang . "'");
      $data['stok'] = $stok;
      $this->view(__CLASS__ . "/form_tambah", $data);
   }

   function cart($id_barang)
   {
      $d = $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_master'] . "' AND id = '" . $id_barang . "'");

      $tambah = $_POST["tambah"];
      $desc = $d['merk'] . " " . $d['model'];
      $harga = $d['harga'] * $tambah;
      $margin = $d['margin'];
      $margin_rp = $harga * ($margin / 100);
      $fee = $margin_rp * ($this->userData['fee'] / 100);
      $jual = $harga + $margin_rp;

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

   function hapusCart($id)
   {
      $this->model("Delete")->where("barang_jual", "id =" . $id);
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
         header("location: " . $this->BASE_URL);
      }
   }
}
