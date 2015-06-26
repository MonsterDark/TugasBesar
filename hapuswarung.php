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



        ?></font> <?php 
              if (empty($pesananalert)) {
                
              }else{
                echo "<font color='#ae0018'>[".$pesananalert;
                echo "]</font>";
              }
             ?></a></li>
        <li><a  href="warungku.php">
          <font style="color: #a349a4" size="4px">
            <?php 

            if ($username != $rw['username'] ) {
              echo "Warungku";
            }else{

              echo $namawarung;
            }


         ?>
          </font>
        </a></li> 
        <li><a  href="keluar.php"><img src="keluar.png"></a></li> 
      </ul>
    </div>
  </div>
  <div class="col-sm-12 row" style="background-color: #5b4181"></div>
`</div>
</header
<div class="content-container">
  <div id="verify_number"></div>
  <div class="container" align="center">
    <h4>Apakah anda yakin ingin menghapus warung?</h4>

   <form method="post">
    <button class="btn btn-default" type="submit" name="ok" value="ok">Hapus warung</button>
    <button class="btn btn-default" type="submit" name="no" value="no">Batal</button>

   </form>
    <?php 
        if (isset($_POST['ok'])) {
              $hapuswarung3 = "DELETE from pesanan where Nama='$namawarung'";
              $hasil3 = mysqli_query($koneksi, $hapuswarung3);

              
              if ($hasil3) {
              $hapuswarung2 = "DELETE from produk where Nama='$namawarung'";
              $hasil2 = mysqli_query($koneksi,$hapuswarung2);
                  if ($hasil2) {
                    $hapuswarung = "DELETE from warung where Nama='$namawarung'";
                    $hasil = mysqli_query($koneksi, $hapuswarung);
                      if ($hasil) {
                        header("Location: profil.php");
                      }else{
                        echo "Gagal";
                      }
                  }else{
                    echo "Gagal";
                  }
              }else{

                echo "Gagal";
              }


        }elseif (isset($_POST['no'])) {
             
          header("Location: profil.php");
         }
     ?>
      
  </div>
</div>
</body>
</html>
