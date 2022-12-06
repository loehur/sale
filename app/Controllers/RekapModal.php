<?php

class RekapModal extends Controller
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
      $data = $this->modul("Main")->list_stok_all();
      $this->view($this->content, $data);
   }
}
