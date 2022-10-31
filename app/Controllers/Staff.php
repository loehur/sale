<?php

class Staff extends Controller
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

      $data = $this->model("Get")->where("user", "id_master = '" . $this->userData['id_user'] . "' AND id_master <> id_user");
      $this->view($this->content, $data);
   }

   public function updateCell_Staff($col, $value, $no_user)
   {
      if ($this->userData['user_tipe'] <> 1) {
         echo "Forbidden Access";
         exit();
      }

      $where = "id_user = '" . $no_user . "'";
      $set = $col . " = " . $value;
      $update = $this->model('Update')->update("user", $set, $where);
      if (isset($update['errno'])) {
         if ($update['errno'] == 0) {
            $this->index();
         }
      } else {
         print_r($update);
      }
   }
}
