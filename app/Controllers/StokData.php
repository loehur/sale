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
      $this->load();
   }

   function load()
   {
      $stok = $this->modul("Main")->list_stok_user($this->setting['toko']);
      $laku = $this->modul("Main")->terlaris();

      $bj = $laku['bj'];
      $bp = $laku['bp'];

      $combine = [];
      foreach ($stok as $d) {
         if ($d['en'] == 0) {
            continue;
         }
         if ($d['stok'] > $this->max_stok) {
            continue;
         }

         $combine[$d['id_user']][$d['id_barang']] = $d;
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
            //unset($combine[$d['id_user']][$d['id_barang']]);
            $combine[$d['id_user']][$d['id_barang']]['laku'] = 0;
         }
      }

      $push = [];

      $col[0][1] = 0;
      $col[0][2] = 0;
      $col[1][1] = 0;
      $col[1][2] = 0;

      $col_active[0] = 1;
      $col_active[1] = 1;

      foreach ($combine as $arr => $val) {
         if (count($val) == 0) {
            continue;
         }

         foreach ($val as $k) {
            if ($k['stok'] < 1) {
               $row = 0;
            } else {
               $row = 1;
            }

            if (isset($push[$row][1][$arr])) {
               $push[$row][1][$arr][$k['id']] = $k;
               $col[$row][1] += 1;
            } else if (isset($push[$row][2][$arr])) {
               $push[$row][2][$arr][$k['id']] = $k;
               $col[$row][2] += 1;
            } else {
               if ($col[$row][1] <= $col[$row][2]) {
                  $col_active[$row] = 1;
               } else {
                  $col_active[$row] = 2;
               }
               $push[$row][$col_active[$row]][$arr][$k['id']] = $k;
               $col[$row][$col_active[$row]] += 1;
            }
         }
      }

      $this->view($this->content, $push);
   }
}
