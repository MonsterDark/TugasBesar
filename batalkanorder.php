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

     }


   $id_produk = $_GET['id_produk'];
   $stok = $_GET['stok'];
   $id_pesanan = $_GET['id_pesanan'];

$deletpesanan = "DELETE from pesanan where id_pesanan=$id_pesanan";
$delete = mysqli_query($koneksi, $deletpesanan);

  
 $selectproduk = "SELECT * from produk where id_produk = $id_produk";
 $hasil = mysqli_query($koneksi, $selectproduk);
 $row = mysqli_fetch_array($hasil, MYSQLI_ASSOC);
 $stok1 = $row['stok'];

$totalstok = $stok1 + $stok;

$update = "UPDATE produk set stok=$totalstok where id_produk=$id_produk";
$hupdate = mysqli_query($koneksi,$update);



 if ($delete) {
	header("Location: profil.php");
 }

 ?>