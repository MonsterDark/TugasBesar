<?php 
session_start();

include "koneksi.php";


$username = $_SESSION['username'];
    $s = "SELECT * from warung where username='$username'";
    $r = mysqli_query($koneksi, $s);
    $rw = mysqli_fetch_array($r, MYSQLI_ASSOC);
      $namawarung = $rw['Nama'];

  if (empty($_SESSION['username'])) {
    header("Location: login.php");

     }elseif (empty($namawarung)) {
     	header("Location: profil.php");
     }

 $id_produk = $_GET['id_produk'];
 $id_pesanan = $_GET['id_pesanan'];
 $harga = $_GET['harga'];
 $stok = $_GET['stok'];

$selectpesanan = "SELECT * from pesanan where id_pesanan=$id_pesanan";
$hasilpesanan = mysqli_query($koneksi, $selectpesanan);
$kol = mysqli_fetch_array($hasilpesanan, MYSQLI_ASSOC);
$user = $kol['username'];





 $selectproduk = "SELECT * from produk where id_produk = $id_produk";
 $hasil = mysqli_query($koneksi, $selectproduk);
 $row = mysqli_fetch_array($hasil, MYSQLI_ASSOC);
 $stok1 = $row['stok'];

$seleuser = "SELECT * from user where username='$username'";
$hasiluser = mysqli_query($koneksi, $seleuser);
$rowuser = mysqli_fetch_array($hasiluser, MYSQLI_ASSOC);
$uang = $rowuser['uang'];
$totaluang = $harga * $stok + $uang;

$updateuser = "UPDATE user set uang=$totaluang where username='$username'";
$totlu = mysqli_query($koneksi,$updateuser);

	if ($totlu) {

      $insertbeli = "INSERT into beli (id_produk,username,stok) values($id_produk,'$user',$stok)";
      $hasilbeli = mysqli_query($koneksi,$insertbeli);


      if ($hasilbeli) {
              $deletepesanan = "DELETE from pesanan where id_pesanan=$id_pesanan";
              $HD = mysqli_query($koneksi,$deletepesanan);
          if ($HD) {
            header("Location: profil.php");
          }else{

            echo (mysqli_error($koneksi));
          }
      }else{
        header("Location: profil.php");
      }
  }else{

    header("Location profil.php");
  }

?>