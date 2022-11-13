<?php

class SubMenu extends Controller
{

   public function __construct()
   {
      $this->session()->check();
      $this->data();
   }

   public function stok()
   {
      $this->view_layout(["title" => __CLASS__]);
      $this->view(__CLASS__ . "/" . __FUNCTION__);
   }
}
