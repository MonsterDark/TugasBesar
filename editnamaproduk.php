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

 ?>