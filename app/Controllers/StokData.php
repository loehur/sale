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
      $data['stok'] = $this->modul("Main")->list_stok_all();
      $data['laris'] = $this->modul("Main")->terlaris();

      foreach ($data['stok'] as $d) {
         foreach ($data['laris'] as $s) {
            if ($s['id_barang'] == $d['id_barang'] && $s['id_user'] == $d['id_user']) {
               $laku = $s['jumlah'];
               if ($laku > 0) {
                  $combine[$d['id_user']][$d['id_barang']] = $d;
                  $combine[$d['id_user']][$d['id_barang']]['laris'] = $laku;
               }
            }
         }
      }

      $push = [];
      $col_1 = 0;
      $col_2 = 0;

      foreach ($combine as $arr => $val) {
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
