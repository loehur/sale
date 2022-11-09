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
      $this->view($this->content, $data);
   }
}
