<?php

class NonTunai extends Controller
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
      $data['antri'] = $this->model("Get")->where("nontunai", "tr_status = 0 LIMIT 20");
      $data['done'] = $this->model("Get")->where("nontunai", "tr_status <> 0 ORDER BY updateTime DESC LIMIT 10");
      $this->view($this->content, $data);
   }

   function confirm($id, $val)
   {
      $this->model("Update")->Update("nontunai", "tr_status = " . $val, "nontunai_id = " . $id);
      $this->index();
   }
}
