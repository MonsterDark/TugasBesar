<?php 
include "koneksi.php";
	session_start();

$username = $_SESSION['username'];
		$selectwr = "SELECT * from warung where username='$username'";
		$resultwr = mysqli_query($koneksi, $selectwr);
		$rowwr = mysqli_fetch_array($resultwr, MYSQLI_ASSOC);
      $namawarung = $rowwr['Nama'];

  if (empty($_SESSION['username'])) {
    header("Location: login.php");

     }elseif ($username != $rowwr['username']) {
     	header("Location: daftarwarungku.php");
     }

 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Warung Jember</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

  <style>
    body {
            background: #fbf5fc;
    }
    #verify_number{
        width: 900px;
        height: 60px;
    }
</style>
</head>
<body>

<header class="navbar navbar-fixed-top";>
  
<div class="col-sm-12 row" style="background-color: #5b4181"></div>
<div class="col-sm-12 row" style="background-color: #5b4181"></div>
  <div class="navbar-inner" style="background-color: #ffffff">
    <div class="container">
      <a href="suksesmasuk.php"><img src="logo.png"></a>
      <ul class="nav navbar-nav navbar-right">
        <li><a  href="profil.php"><font style="color: #a349a4" size="4px"><span class="glyphicon glyphicon-user"></span> <?php echo "$username";


              $selectpesanan1 = "SELECT COUNT(*) as jumlahpesanan from pesanan where Nama='$namawarung'";
              $jumlahpesanan = mysqli_query($koneksi, $selectpesanan1);
              $rowwww = mysqli_fetch_array($jumlahpesanan, MYSQLI_ASSOC);
              $pesananalert = $rowwww['jumlahpesanan'];


         ?></font>
               <?php 
              if (empty($pesananalert)) {
                
              }else{
                echo "<font color='#ae0018'>[".$pesananalert;
                echo "]</font>";
              }
             ?>
         </a></li>
        <li><a  href="warungku.php"><font style="color: #a349a4" size="4px"><?php echo $namawarung; ?></font></a></li> 
        <li><a  href="keluar.php"><img src="keluar.png"></a></li> 
      </ul>
    </div>
  </div>
  <div class="col-sm-12 row" style="background-color: #5b4181"></div>
`</div>
</header>
<div class="container">
<div id="verify_number"></div>
  <div class="container" align="center">
  	<div class="content-container">
      <div  class="tab-pane fade in active">
      <h3>Warungku</h3>
      <?php 


                $slect = "SELECT * from warung where username='$username'";
                $rsult = mysqli_query($koneksi, $slect);
                while ($ow = mysqli_fetch_array($rsult, MYSQLI_ASSOC)) {
                  echo $ow['Nama'];
                  $wru = $ow['Nama'];
                }




             ?>
              <div class="col-sm-12 row" style="background-color: #5b4181"></div><br/>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row-fluid">
    <div class="span8">
      <div class="row-fluid">
      <a class="btn btn-default" href="tambahbarang.php" role="button"><span class="glyphicon glyphicon-plus"></span>Tambah Barang</a>
        <div class="span4">
        <?php 


              $username = $_SESSION['username'];

              if ($username != $rowwr['username']) {
                echo "<div class='text-left user-info'>
                        <a href='daftarwarungku.php'><h1>Buat Warung</h1></a>
                      </div>
                ";
              }else{
          

                $slect = "SELECT * from warung where username='$username'";
                $rsult = mysqli_query($koneksi, $slect);
                while ($ow = mysqli_fetch_array($rsult, MYSQLI_ASSOC)) {
                  $wru = $ow['Nama'];
                  $kec = $ow['kecamatan'];
                  $des = $ow['desa'];
                  $lsg = $ow['selogan'];
                  $jl = $ow['jalan'];
                  $kp = $ow['kodepos'];
                }


                $selectproduk = "SELECT * from produk where Nama='$wru'";
                $hasilproduk = mysqli_query($koneksi, $selectproduk);
                $kolomproduk = mysqli_fetch_array($hasilproduk, MYSQLI_ASSOC);

                if ($wru != $kolomproduk['Nama']) {
                  echo "<h3>Tidak Ada barang yg Di jual</h3>";
                }else{

?>
 <div class="span4"><h4>Daftar barang yang di jual</h4></div>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Kondisi</th>
                <th>Kategori</th>
                <th>Stock</th>
              </tr>
              <?php
              echo "<tbody>"; 
                $hasilproduk2 = mysqli_query($koneksi, $selectproduk);

              while ($kol = mysqli_fetch_array($hasilproduk2, MYSQLI_ASSOC)) {
                  echo "<tr>";
                  echo "<td>";
                  echo $kol['namaproduk'];
                  echo "</td>";
                  echo "<td>";
                  echo "<a href='gantiharga.php?id_produk=$kol[id_produk]&&namaproduk=$kol[namaproduk]'>";
                  echo $kol['harga'];
                  echo "</a>";
                  echo "</td>";
                  echo "<td>";
                  echo $kol['kondisi'];
                  echo "</td>";
                  echo "<td>";
                  echo $kol['namakategori'];
                  echo "</td>";
                  echo "<td>";
                  echo "<a href='perbaruistok.php?id_produk=$kol[id_produk]&&namaproduk=$kol[namaproduk]'>";
                  echo $kol['stok'];
                  echo "</a>";
                  echo "</td>";
                  echo "<td>";
                  echo "<a href='hapusbarang.php?id_produk=$kol[id_produk]'>
                        <span class='glyphicon glyphicon-trash'></span> Hapus 
                        </a>";
                  echo "</td>";
                  echo "</tr>";
                }  

               ?>
            </thead>
          </table>

           <?php   } }    ?>
          
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
