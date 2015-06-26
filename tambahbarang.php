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
        <li><a  href="warungku.php">
        <font style="color: #a349a4" size="4px">
              
          <?php 

            if ($username != $rowwr['username'] ) {
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
</header>
<div class="container">
<div id="verify_number"></div>
  <div class="container" align="center">
  	<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3><font color="#CC00CC">Tambah Barang</font></h3>
       <div class="col-sm-12 row" style="background-color: #5b4181"></div><br/>
 
  <form class="form-horizontal form-register box box-white box-shadow mb-30" role="form" method="post">
    <div class="form-group">
      <label class="col-sm-4 control-label">Nama Produk</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="text" name="namaproduk" value="<?php 
            if (isset($_POST['ok'])) {
              echo $_POST['namaproduk'];
            }
         ?>">
      </div>
    </div>
     <div class="form-group">
      <label class="col-sm-4 control-label">Kategori</label>
      <div class="col-sm-4">
        <?php 
            $selectkategori = "SELECT * from kategori order by namakategori";
            $hasilkategori = mysqli_query($koneksi, $selectkategori);
  
            echo "<select name='kategori' class='form-control'>";
            
              if (isset($_POST['ok'])) {
                 echo "<option value=".$_POST['kategori'].">";
              echo $_POST['kategori'];
              echo "</option>";
            }else{
              echo "<option value".null.">";
              echo "Kategori";
              echo "</option>";
            }

            
                while ($a = mysqli_fetch_array($hasilkategori, MYSQLI_ASSOC)) {
                  # code...

              echo "<option value=".$a['namakategori'].">".$a['namakategori']."</option>";
                  }
            echo "</select>";

        ?>
      </div>
    </div>
     <div class="form-group">
      <label class="col-sm-4 control-label">Kondisi</label>
      <div class="radio col-sm-4">
        <div class="container">
              <div align="left"><input type="radio" name="kondisi" id="optionRadios1" value="baru" >Baru</div>
              <div align="left"><input type="radio" name="kondisi" id="optionRadios2" value="Bekas" >Bekas</div>
        </div>
      </div>
    </div>
     <div class="form-group">
      <label class="col-sm-4 control-label">Harga/buah</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="number" name="harga" value="<?php 
           if (isset($_POST['ok'])) {
              echo $_POST['harga'];
            } ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label">Banyak barang/Stok</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="number" name="stok" value="<?php 
          if (isset($_POST['ok'])) {
              echo $_POST['stok'];
            } ?>">
      </div>
    </div>
    <?php 

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

                if (isset($_POST['ok'])) {
                   $namaproduk = $_POST['namaproduk'];
                   $kategori = $_POST['kategori'];
                   $kondisi = isset($_POST['kondisi']) ? $_POST['kondisi']:'';
                   $harga = $_POST['harga'];
                   $stok = $_POST['stok'];

                   $insertproduk = "INSERT into produk (harga, namaproduk, kondisi, namakategori, Nama, stok) 
                                    values ('$harga', '$namaproduk', '$kondisi', '$kategori', '$wru', $stok)";
                   
                   if ($namaproduk == null) {
                      echo "<div class='alert alert-danger container-fluid'>";
                      echo "Nama Produk harus diisi";
                      echo "</div>";
                   }elseif ($kategori == null) {
                      echo "<div class='alert alert-danger container-fluid'>";
                      echo "Silahkan pilih kategori yang tersedia";
                      echo "</div>";
                   }elseif ($kondisi==null) {
                      echo "<div class='alert alert-danger container-fluid'>";
                      echo "Pilih Kondisi barang anda";
                      echo "</div>";
                   }elseif ($harga == null) {
                      echo "<div class='alert alert-danger container-fluid'>";
                      echo "Harga barang tidak boleh kosong";
                      echo "</div>";
                   }elseif ($stok < 1 ) {
                      echo "<div class='alert alert-danger container-fluid'>";
                      echo "Jumlah stok harus lebih dari 0 ";
                      echo "</div>";
                   }elseif ($hasilproduk = mysqli_query($koneksi, $insertproduk)) {
                     echo '<meta http-equiv="refresh" content="0; url=warungku.php">';
                   }
                }elseif (isset($_POST['no'])) {
                  header("Location: warungku.php");
                }

     ?>
    <button type="submit" name="ok" value="ok" class="btn btn-default"><font color="#CC00CC">Tambah</font></button>
    <button type="submit" name="no" value="no" class="btn btn-default"><font color="#CC00CC">Batal</font></button>
  </form><br/>
  <div class="col-sm-12 row" style="background-color: #5b4181"></div><br/>
  </div>
  </div>
  </div>
</div>
</body>
</html>
