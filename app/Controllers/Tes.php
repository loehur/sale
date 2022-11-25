<?php

class Tes extends Controller
{
   function __construct()
   {
      $this->session()->check();
      $this->data();
   }
   function index()
   {
      $bj = $this->model("Get")->cols_where_groubBy_orderBy("barang_jual", "id_barang, id_user, SUM(jumlah) as jumlah", "id_master = '" . $this->userData['id_user'] . "' AND op_status = 1", "id_barang, id_user", "id_user ASC");
      $bp = $this->model("Get")->cols_where_groubBy_orderBy("barang_pakai", "id_barang, id_user, SUM(jumlah) as jumlah", "id_master = '" . $this->userData['id_user'] . "' AND op_status = 1", "id_barang, id_user", "id_user ASC");
      $new = [];

      echo "<pre>";
      print_r(json_encode($bj, JSON_PRETTY_PRINT));
      echo "</pre>";

      echo "<hr>";
      echo "<pre>";
      print_r(json_encode($bp, JSON_PRETTY_PRINT));
      echo "</pre>";

      foreach ($bj as $key => $a) {
         $same = false;
         foreach ($bp as $b) {
            if ($a['id_barang'] == $b['id_barang']) {
               $same = true;
               $a['jumlah'] += $b['jumlah'];
               $new[$key] = $a;
            }
         }
         if ($same == false) {
            $new[$key] = $a;
         }
      }
      echo "<hr>";
      echo "<pre>";
      print_r(json_encode($new, JSON_PRETTY_PRINT));
      echo "</pre>";
   }
}
