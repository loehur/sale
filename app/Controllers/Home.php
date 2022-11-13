<?php

class Home extends Controller
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
      $data['kas'] = $this->modul('Main')->kas();
      $data['riwayat'] = $this->modul('Main')->riwayat_jual();
      $this->view($this->content, $data);
   }
}
