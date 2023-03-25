<?php

class RekapModalInventaris extends Controller
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
      $data = $this->modul("Main")->list_stok_all_inven();
      $push = [];
      foreach ($data as $a) {
         $susut = 0;
         $susut = ($a['harga'] / $a['umur']) / 12;
         if (isset($push[$a['id_user']]['modal'])) {
            $push[$a['id_user']]['modal'] += $a['harga'];
         } else {
            $push[$a['id_user']]['modal'] = $a['harga'];
         }

         if (isset($push[$a['id_user']]['susut'])) {
            $push[$a['id_user']]['susut'] += $susut;
         } else {
            $push[$a['id_user']]['susut'] = $susut;
         }
      }
      $this->view($this->content, $push);
   }
}
