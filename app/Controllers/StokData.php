<?php

class StokData extends Controller
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
      $stok = $this->modul("Main")->list_stok_all();
      $laku = $this->modul("Main")->terlaris();

      $bj = $laku['bj'];
      $bp = $laku['bp'];

      foreach ($stok as $key => $d) {
         $sisa = $d['stok'];
         $user = $d['id_user'];

         $combine[$d['id_user']][$d['id_barang']] = $d;
         $combine[$d['id_user']][$d['id_barang']]['stok_pengganti'] = 0;

         if ($sisa == 0 && strlen($d['pengganti']) > 0) {
            foreach ($stok as $p) {
               if ($p['id_barang'] == $d['pengganti'] && $p['id_user'] == $user) {
                  $combine[$d['id_user']][$d['id_barang']]['stok_pengganti'] = $p['stok'];
               }
            }
         }

         foreach ($bj as $s) {
            if ($s['id_barang'] == $d['id_barang'] && $s['id_user'] == $d['id_user']) {
               $laku = $s['jumlah'];
               if (isset($combine[$d['id_user']][$d['id_barang']]['laku'])) {
                  $combine[$d['id_user']][$d['id_barang']]['laku'] += $laku;
               } else {
                  $combine[$d['id_user']][$d['id_barang']]['laku'] = $laku;
               }
            }
         }

         foreach ($bp as $s) {
            if ($s['id_barang'] == $d['id_barang'] && $s['id_user'] == $d['id_user']) {
               $laku = $s['jumlah'];
               if (isset($combine[$d['id_user']][$d['id_barang']]['laku'])) {
                  $combine[$d['id_user']][$d['id_barang']]['laku'] += $laku;
               } else {
                  $combine[$d['id_user']][$d['id_barang']]['laku'] = $laku;
               }
            }
         }

         //JIKA TIDAK LAKU SEMBUNYIKAN
         if (!isset($combine[$d['id_user']][$d['id_barang']]['laku'])) {
            unset($combine[$d['id_user']][$d['id_barang']]);
         }
      }

      $push = [];
      $col_1 = 0;
      $col_2 = 0;

      foreach ($combine as $arr => $val) {
         if (count($val) == 0) {
            continue;
         }
         if ($col_1 <= $col_2) {
            $push[1][$arr] = $val;
            $col_1 += count($val);
         } else {
            $push[2][$arr] = $val;
            $col_2 += count($val);
         }
      }


      $this->view($this->content, $push);
   }
}
