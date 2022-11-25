<?php

class Pindah extends Controller
{
   function index()
   {
      $d = $this->model("Get")->where("barang_jual", "used = 1");

      $table = "barang_pakai";
      $columns = 'id_master, id_user, id_barang, deskripsi, jumlah, harga, op_status';
      foreach ($d as $a) {
         $values = "'" . $a['id_master'] . "','" . $a['id_user'] . "','" . $a['id_barang'] . "','" . $a['deskripsi'] . "'," . $a['jumlah'] . "," . $a['harga'] . "," . $a['op_status'];
         $do = $this->model('Insert')->cols($table, $columns, $values);
         if ($do['errno'] == 0) {
            $del = $this->model("Delete")->where("barang_jual", "id = " . $a['id']);
            if ($del['errno'] <> 0) {
               print_r($del['error']);
               break;
            }
         } else {
            print_r($do['error']);
            break;
         }
      }

      $d = $this->model("Get")->where("barang_jual", "used = 1");
      print_r($d);
   }
}
