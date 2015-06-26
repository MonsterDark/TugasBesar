<?php 
include "koneksi.php";
  session_start();


    $selectwr = "SELECT * from warung";
    $resultwr = mysqli_query($koneksi, $selectwr);
    $rowwr = mysqli_fetch_array($resultwr, MYSQLI_ASSOC);


$username = $_SESSION['username'];
  if (empty($_SESSION['username'])) {
    header("Location: login.php");

     }elseif ($username != $rowwr['username']) {
      header("Location: daftarwarungku.php");
     }

     $id_produk = $_GET['id_produk'];

     if ($id_produk == null) {
         header("Location: warungku.php");
     }else{
        $deleteproduk = "DELETE from produk where id_produk=$id_produk";
        $hapus = mysqli_query($koneksi, $deleteproduk);
        if ($hapus) {
            header("Location: warungku.php");
        }
     }
 ?>