<?php

class StokTransfer extends Controller
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
            $this->form_tambah($kode_barang, $stok, $id_barang);
         }
      }
   }

   function keranjang()
   {
      $data = $this->modul("Main")->data_transfer_keluar();
      $this->view(__CLASS__ . "/keranjang", $data);
   }

   function form_tambah($kode_barang, $stok, $id_barang)
   {
      $data['stok'] = $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_master'] . "' AND kode_barang = '" . $kode_barang . "'");
      $data['sisa'] = $stok;
      $this->view(__CLASS__ . "/form_tambah", $data);
   }

   function cart($id_barang)
   {
      $tambah = $_POST["tambah"];
      $tujuan = $_POST["tujuan"];

      $table = "barang_masuk";
      $columns = 'id_master, id_barang, jumlah, id_user, id_sumber, op_status';
      $values = "'" . $this->userData['id_master'] . "','" . $id_barang . "'," . $tambah . ",'" . $tujuan . "','" . $this->userData['id_user'] . "',0";
      $do = $this->model('Insert')->cols($table, $columns, $values);

      if ($do['errno'] == 0) {
         echo "Transfer " . $tambah . ", SUKSES!";
      } else {
         print_r($do);
      }
   }

   function hapusCart($id)
   {
      $this->model("Delete")->where("barang_masuk", "id =" . $id);
      $this->index();
   }
}
