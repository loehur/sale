<?php

class Pindah extends Controller
{
   function index()
   {
      $d = $this->model("Get")->where("barang_jual", "used = 1");
      print_r($d);
   }
}
