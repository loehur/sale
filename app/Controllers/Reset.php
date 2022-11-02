<?php

class Reset extends Controller
{
   public function pass($id, $code)
   {
      $code += 99;
      $where = "id_user = '" . $id . "' AND jenis = 1";
      $cek = $this->model('Count')->where('reset_code', $where);
      if ($cek > 0) {
         $set = "reset_code ='" . md5($code) . "'";
         $update = $this->model('Update')->update('reset_code', $set, $where);
         if ($update['errno'] == 0) {
            echo "SUKSES!";
         } else {
            echo "ERROR!";
         }
      } else {
         $cols = "id_user, reset_code, jenis";
         $vals = "'" . $id . "','" . md5($code) . "',1";
         $insert = $this->model('Insert')->cols('reset_code', $cols, $vals, $where);
         if ($insert['errno'] == 0) {
            echo "SUKSES!";
         } else {
            echo "ERROR!";
         }
      }
   }
}
