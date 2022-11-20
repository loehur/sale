<?php

class SubMenu extends Controller
{

   public function __construct()
   {
      $this->session()->check();
      $this->data();
   }

   public function i($subMenu)
   {
      $this->view_layout(["title" => $subMenu]);
      $this->view(__CLASS__ . "/" . $subMenu);
   }
}
