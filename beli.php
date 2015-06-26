<?php 
session_start();

include "koneksi.php";

$id_produk = $_GET['id_produk'];
$Nama = $_GET['Nama'];


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
<div class="container">
  <div id="verify_number"></div>
  <div class="container">
    <?php 
    	$selectproduk = "SELECT * from produk where id_produk=$id_produk";
    	$hasil = mysqli_query($koneksi, $selectproduk);
    	$kolpro = mysqli_fetch_array($hasil, MYSQLI_ASSOC);
      $nmwrpenjual = $kolpro['Nama'];
      $stokproduk = $kolpro['stok'];

     ?>
     <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3><font color="#CC00CC">Beli Produk <?php echo $kolpro['namaproduk']; ?></font></h3>
      <div  class="col-sm-3">
      	<ul>
      	<li>
      		<?php echo $kolpro['namakategori']; ?>
      	</li>
      	<li>
      		<?php echo $kolpro['kondisi']; ?>
      	</li>
      	<li>
      		Harga/buah Rp.<?php echo $kolpro['harga']; ?>
      	</li>
      	<li>
      		Jumlah stok <?php echo $kolpro['stok']; ?>
      	</li>
      	<li>
      		Dijual di warung <?php echo $kolpro['Nama']; ?>
      	</li>
      </ul>
      </div>
      <div id="verify_number"></div>
      <div class="col-sm-12 row" style="background-color: #5b4181"></div>
      <div id="verify_number"></div>
  	 <form  role="form" method="post">
  	 	<div class="form-group">
      <label class="col-sm-2 control-label">Banyak stok yang akan diorder</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="number" name="stok">
        <button type="submit" name="ok" value="ok" class="btn btn-default"><font color="#CC00CC">Order</font></button>
    <button type="submit" name="no" value="no" class="btn btn-default"><font color="#CC00CC">Batal</font></button>
      </div>     
    	</div>
    
    <?php 
    		if (isset($_POST['no'])) {
    			header("Location: suksesmasuk.php");
    		}elseif (isset($_POST['ok'])) {

    			$stok = $_POST['stok'];

          if ($namawarung == $nmwrpenjual) {
            echo "<div class='alert alert-danger container-fluid'>";
                      echo "Tidak bisa membeli barang dari warung Anda";
                      echo "</div>";
          }else{

    		  	if ($stok < 1 ) {
             		  echo "<div class='alert alert-danger container-fluid'>";
                      echo "Jumlah stok harus lebih dari 0 ";
                      echo "</div>";
         		}elseif ($stok > $kolpro['stok']) {
         			  echo "<div class='alert alert-danger container-fluid'>";
                      echo "Jumlah stok Tidak tersedia!";
                      echo "</div>";
         		}else{

         			$order = "INSERT into pesanan (username,id_produk,Nama,stok) values ('$username', $id_produk, '$nmwrpenjual',$stok)";
         			$proses = mysqli_query($koneksi, $order);
         			if ($proses) {

                    $totalstok = $stokproduk - $stok;
                    
                $update = "UPDATE produk set stok='$totalstok' where id_produk=$id_produk";
                $hasilstok = mysqli_query($koneksi, $update);
                if ($hasilstok) {
                  header("Location: profil.php");
                }else{
                      echo "<div class='alert alert-danger container-fluid'>";
                      echo "Gagal";
                      echo $hasilstok;
                      echo $username;
                      echo(mysqli_error($koneksi));
                      echo "</div>";
                }
         			}else{
         				 echo "<div class='alert alert-danger container-fluid'>";
                 echo "Gagal";
                      echo $id_produk;
                      echo $username;
                      echo(mysqli_error($koneksi));
                      echo "</div>";
         			}
         		}
          }
         	}

    	 ?>

  	 </form>
  </div>
</div>
</div>
</body>
</html>