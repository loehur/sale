<?php

class Register extends Controller
{
   function __construct()
   {
      $this->data();
   }

   function index()
   {
      if (isset($_SESSION['login_payment'])) {
         if ($_SESSION['login_payment'] == TRUE) {
            header('Location: ' . $this->BASE_URL . "Home");
         }
      }
      $this->view('login/register');
   }

   function reset_pass()
   {
      if (isset($_SESSION['login_payment'])) {
         if ($_SESSION['login_payment'] == TRUE) {
            header('Location: ' . $this->BASE_URL . "Home");
         }
      }
      $this->view('login/forget_pass');
   }

   function insert()
   {
      if (isset($_SESSION['login_payment'])) {
         if ($_SESSION['login_payment'] == TRUE) {
            header('Location: ' . $this->BASE_URL . "Home");
         }
      }

      $pass = $_POST["password"];
      $repass = $_POST["repass"];

      if ($pass <> $repass) {
         echo "Password tidak Cocok!";
         exit();
      }

      $table = "user";
      $columns = 'id_user, nama, password, user_tipe, id_master';
      $values = "'" . $_POST["HP"] . "','" . $_POST["nama"] . "','" . md5($pass) . "',1,'" . $_POST["HP"] . "'";
      $do = $this->model('M_DB_1')->insertCols($table, $columns, $values);

      if ($do['errno'] == 0) {
         echo 1;
      } else {
         print_r($do);
      }
   }

   function tambah_staff()
   {
      if ($this->userData['user_tipe'] <> 1) {
         echo "Forbidden Access";
         exit();
      }

      $table = "user";
      $columns = 'id_user, nama, id_master, user_tipe, en, fee';
      $values = "'" . $_POST["HP"] . "','" . $_POST["nama"] . "','" . $this->userData['id_master'] . "'," . $_POST['user_tipe'] . ",1," . $_POST['fee'];
      $do = $this->model('Insert')->cols($table, $columns, $values);

      if ($do['errno'] == 0) {
         echo 1;
      } else {
         print_r($do['error']);
      }
   }

   function ganti_password()
   {
      $nomor = "";
      if (isset($_POST["no_user"])) {
         $nomor = $_POST["no_user"];
      } else {
         $nomor = $this->userData['no_user'];
      }
      $code_reset_pass = md5($_POST["reset_code"]);

      $where = "no_user = '" . $this->userData['no_user'] . "' AND reset_code = '" . $code_reset_pass . "' AND jenis = 1";
      $reset_code = $this->model('M_DB_1')->get_where_row('reset_code', $where);
      if (!isset($reset_code['reset_code'])) {
         echo "Reset Code Salah!";
         exit();
      }

      $where = "no_user = '" . $nomor . "'";
      $reset_code_old = $this->model('M_DB_1')->get_where_row('user', $where)['pass_reset_code'];

      if ($reset_code['reset_code'] == $reset_code_old) {
         echo "Reset Code Expired!";
         exit();
      }

      $pass = $_POST["password"];
      $repass = $_POST["repass"];

      if (strlen($pass) < 6) {
         echo "Password dan PIN minimal 6 karakter!";
         exit();
      }

      if ($pass <> $repass) {
         echo "Konfirmasi Password tidak Cocok!";
         exit();
      }

      $where = "id_user = " . $this->userData['id_user'];
      $set = "password = '" . md5($pass) . "', pass_reset_code = '" . $reset_code['reset_code'] . "'";
      $this->model('M_DB_1')->update("user", $set, $where);
      echo 1;
   }

   function ganti_password_first()
   {

      $pass = $_POST["password"];
      $repass = $_POST["repass"];

      if (strlen($pass) < 6) {
         echo "Password dan PIN minimal 6 karakter!";
         exit();
      }

      if ($pass <> $repass) {
         echo "Konfirmasi Password tidak Cocok!";
         exit();
      }

      $where = "id_user = " . $this->userData['id_user'];
      $set = "password = '" . md5($pass) . "', pass_reset_code = 'abcd'";
      $this->model('M_DB_1')->update("user", $set, $where);
      echo 1;
   }

   function updateCell_Master($col)
   {
      if ($this->userData['user_tipe'] <> 1) {
         echo "Forbidden Access";
         exit();
      }

      if (isset($_POST["f1"])) {
         $value = $_POST["f1"];
      } else {
         if (isset($_POST[$col])) {
            $value = $_POST[$col];
         } else {
            $value = 0;
         }
      }

      $where = "no_user = '" . $this->userData['no_master'] . "'";
      $set = $col . " = " . $value;
      $update = $this->model('M_DB_1')->update("user", $set, $where);
      if (isset($update['errno'])) {
         if ($update['errno'] == 0) {
            echo 1;
         }
      } else {
         print_r($update);
      }
   }
}
