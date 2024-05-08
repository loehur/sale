<?php

class Home extends Controller
{
   function __construct()
   {
      $this->session()->check();
      $this->data();
      $this->content = __CLASS__ . $this->content;
   }

   function index()
   {

      if (isset($_POST['m'])) {
         $month = $_POST['y'] . "-" . $_POST['m'];
      } else {
         $month = date("Y-m");
      }

      $this->view_layout(["title" => __CLASS__]);
      if ($this->userData['id_user'] == $this->userData['id_master']) {
         exit();
      }
      $data['kas'] = $this->modul('Main')->kas();
      $data['riwayat'] = $this->modul('Main')->riwayat_jual($month);
      $this->view($this->content, $data);
   }

   function setID()
   {
      $this->userData['id_user'] = $_POST['toko'];
      $this->synchrone();
   }

   function nontunai()
   {
      $ref = $_POST['ref'];
      $jumlah = $_POST['jumlah'];
      $metode = $_POST['metode'];
      $note = $_POST['note'];
      //cek max bayar
      $max = $this->modul("Main")->trx_bill($ref);
      if ($jumlah > $max) {
         echo "Pembayaran melebihi jumlah tagihan!";
         exit();
      }
      $cols = "ref, jumlah, metode, note, id_user";
      $vals = "'" . $ref . "'," . $jumlah . ",'" . $metode . "','" . $note . "','" . $this->userData['id_user'] . "'";
      $do = $this->model('Insert')->cols("nontunai", $cols, $vals);
      if ($do == 0) {
         echo 0;
      } else {
         echo $do['error'];
      }
   }
}
