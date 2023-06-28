<?php

class Akun extends Controller
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
      $this->view($this->content);
   }

   public function updatePass()
   {
      $pass = $_POST['pass'];
      $pass_ = $_POST['pass_'];
      $pass__ = $_POST['pass__'];

      if ($pass_ <> $pass__) {
         echo "Password Baru tidak Cocok";
         exit();
      }

      if (md5($pass) <> $this->userData['password']) {
         echo "Password Lama Salah!";
         exit();
      }

      $where = "id_user = '" . $this->userData['id_user'] . "'";
      $set = "password = '" . md5($pass_) . "'";
      $update = $this->model('Update')->update("user", $set, $where);
      if (isset($update['errno'])) {
         if ($update['errno'] == 0) {
            $this->synchrone();
            echo 1;
         }
      } else {
         print_r($update);
      }
   }
}
