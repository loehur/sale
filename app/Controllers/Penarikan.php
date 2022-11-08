<?php

class Penarikan extends Controller
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
      $data['riwayat'] = $this->modul('Main')->riwayat_jual(10);
      $this->view($this->content, $data);
   }

   public function tarik($jenis)
   {
      $kas = $this->modul("Main")->kas();
      $jumlah = $_POST["jumlah"];
      $pass = $_POST["pass"];
      $ket = $_POST["ket"];

      $kas_status = 1;

      switch ($jenis) {
         case 0:
            //CEK SISA CUCUP GAK
            if ($jumlah > $kas['sup']) {
               echo "Saldo Supplier Tidak Cukup";
               exit();
            }
            if (md5($pass) == $this->masterData['password']) {
               $kas_status = 1;
            } else {
               echo "Password Supplier tidak Cocok";
               exit();
            }
            break;
         case 1;
            //CEK SISA CUCUP GAK
            if ($jumlah > $kas['fee']) {
               echo "Saldo Fee Tidak Cukup";
               exit();
            }
            if (md5($pass) == $this->userData['password']) {
               $kas_status = 1;
            } else {
               echo "Password tidak Cocok";
               exit();
            }
            break;
      }

      //EKSEKUSI
      $columns = 'id_user, keterangan, jumlah, kas_mutasi, kas_status, kas_jenis, id_master';
      $values = "'" . $this->userData['id_user'] . "','" . $ket . "','" . $jumlah . "',0,'" . $kas_status . "'," . $jenis . ",'" . $this->userData['id_master'] . "'";
      $do = $this->model('Insert')->cols("kas", $columns, $values);

      if ($do['errno'] == 0) {
         echo 1;
      } else {
         print_r($do['error']);
      }
   }
}
