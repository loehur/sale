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
      $data = $this->modul("Main")->list_stok_masuk();
      $this->view($this->content, $data);
   }

   function cek($kode_barang)
   {
      if (strlen($kode_barang) == 0) {
         exit();
      }

      $data = $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_master'] . "' AND kode_barang = '" . $kode_barang . "'");
      if (isset($data['id'])) {
         $id_barang = $data['id'];
      } else {
         exit();
      }


      $data_ = $this->model("Get")->where("barang_masuk", "id_master = '" . $this->userData['id_master'] . "' AND id_barang = " . $id_barang . " AND id_user = '" . $this->userData['id_user'] . "' AND op_status <> 1");
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
         $data[$key]['satuan'] = $barang['satuan'];
      }

      $this->view(__CLASS__ . "/cek_masuk", $data);
   }

   function terima($terima, $id, $sumber)
   {
      $rak = $_POST['rak'];
      $where = "id_user = '" . $this->userData['id_user'] . "' AND id = " . $id;
      $set = "op_status = " . $terima;
      $do =  $this->model('Update')->update("barang_masuk", $set, $where);
      if ($do['errno'] == 0) {
         $id_barang = $this->modul("Main")->id_barang_masuk($id);
         $this->modul("Main")->update_stok($id_barang, $rak);
         $this->modul("Main")->update_stok_master($sumber, $id_barang, $rak);
         echo $terima;
      } else {
         echo $do['error'];
      }
   }

   function terima_pakai($terima, $id, $sumber, $jumlah)
   {
      $rak = $_POST['rak'];
      $where = "id_user = '" . $this->userData['id_user'] . "' AND id = " . $id;
      $set = "op_status = " . $terima;
      $do =  $this->model('Update')->update("barang_masuk", $set, $where);
      if ($do['errno'] == 0) {
         $id_barang = $this->modul("Main")->id_barang_masuk($id);
         $this->modul("Main")->update_stok($id_barang, $rak);
         $this->modul("Main")->update_stok_master($sumber, $id_barang, $rak);
         $this->cart_pakai($id_barang, $jumlah);
         $this->cekOut_pakai();
         echo $terima;
      } else {
         echo $do['error'];
      }
   }

   function cart_pakai($id_barang, $tambah)
   {
      $d = $this->model("Get")->where_row("barang_data", "id_master = '" . $this->userData['id_master'] . "' AND id = '" . $id_barang . "'");

      $desc = $d['merk'] . " " . $d['model'] . " " . $d['deskripsi'];
      $harga = $d['harga'] * $tambah;

      $table = "barang_pakai";
      $sat = $d['satuan'];
      $columns = 'id_master, id_user, id_barang, deskripsi, jumlah, harga, op_status, satuan';
      $values = "'" . $this->userData['id_master'] . "','" . $this->userData['id_user'] . "'," . $id_barang . ",'" . $desc . "'," . $tambah . "," . $harga . ",0," . $sat;
      $do = $this->model('Insert')->cols($table, $columns, $values);

      if ($do['errno'] == 0) {
         $set = "sort = sort+1";
         $whereSort = "id = " . $id_barang;
         $this->model('Update')->update("barang_data", $set, $whereSort);
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
      }
   }
}
