<?php 
session_start();
include "koneksi.php";

$namakategori = $_GET['namakategori'];

$username = $_SESSION['username'];
    $s = "SELECT * from warung where username='$username'";
    $r = mysqli_query($koneksi, $s);
    $rw = mysqli_fetch_array($r, MYSQLI_ASSOC);
      $namawarung = $rw['Nama'];

 if (empty($_SESSION['username'])) {
    echo '<meta http-equiv="refresh" content="0; url=suksesmasuk.php?">';

     }elseif ($namakategori == null) {
       header("Location: suksesmasuk.php");
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
   #kategori{
      width: 1090px;
      height: 200px
    }
    .putih{
      background-color: #ffffff;
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
</header>

<div class="container">
  <div id="verify_number"></div>
  <div class="container" align="center">
    <div class="container">
      <div id="home" class="tab-pane fade in active">
          <h3>Warung Jember</h3>
          <p>Tempat beli Online warung jember!! Buruan daftakan warungmu.</p>
          <div class="span12 putih" align="left" id="kategori">
            <div class="container">
              <div class="span4"><h3>Kategori</h3></div>
              <div class="span8">
                <?php 
            include "koneksi.php";

            $selectkategori = "SELECT namakategori from kategori";
            $hasilkategori = mysqli_query($koneksi, $selectkategori);
              echo "<a class='btn btn-default' href ='suksesmasuk.php'>";
              echo "Semua kategori";
              echo "</a>";
            while ($kolkat = mysqli_fetch_array($hasilkategori, MYSQLI_ASSOC) ){
              echo "<a class='btn btn-default' href ='tampilkan.php?namakategori=$kolkat[namakategori]'>";
              echo $kolkat['namakategori'];
              echo "</a>";
            }

           ?>
              </div>
            </div>
          </div>
        </div>   
      </div>
    </div>
          <div class="span12" align="left">
            <div class="container">
              <div class="span4"><h3>Kategori <?php echo "$namakategori"; ?></h3></div>
              <div class="span5">
               	<div class="container">
               		<table class="table table-hover">
               		<thead>
               			<tr>
               				<th><h2>Beli Produk!!</h2></th>
               			</tr>
               			<?php 
               				$selectproduk = "SELECT * FROM produk where namakategori='$namakategori' ORDER BY RAND()  LIMIT 10 ";
               				$hasil = mysqli_query($koneksi, $selectproduk);
               				echo "<tbody>";
               				while ($kol = mysqli_fetch_array($hasil, MYSQLI_ASSOC)) {
                        if (empty($kol['stok'])) {
                                 echo "<tr>";
                              echo "<td>";
                                echo "<h2>Barang tidak tersedia untuk kategori ini</h2>";
                              echo "</td>";
                              echo "</tr>";
                    
                    }else{
               					echo "<tr>";
                echo "<td>";
                echo "<ul>";
                  echo "<li>";
                  echo "<h4>";
                    echo $kol['namaproduk'];
                  echo "</h4>";
                      echo "<ul>";
                        echo "<li>";
                          echo $kol['namakategori'];
                        echo "</li>";
                        echo "<li>";
                          echo $kol['kondisi'];
                        echo "</li>";
                        echo "<li>";
                          echo "Stok : ".$kol['stok'];
                        echo "</li>";
                         echo "<li>";
                          echo "Dijual di Warung ";
                          echo "<a href='tampilkanwarung.php?Nama=$kol[Nama]'>";
                          echo $kol['Nama'];
                          echo "<a>";
                        echo "</li>";
                      echo "</ul>";
                  echo "</li>";
                echo "</ul>";
                echo "</td>";
                echo "<td>";
                  echo "<br/><br/><h4>Rp.".$kol['harga']."</h4>";
                echo "</td>";
                echo "<td>";
                  echo "<br/><br/><a href='beli.php?id_produk=$kol[id_produk]&&warung=$kol[Nama]'>
                        <h4><span class='glyphicon glyphicon-shopping-cart'></span> ORDER </h4>
                  </a>";
                echo "</td>";
                echo "</tr>";
               				}
                    }
               				echo "</tbody>";

               			 ?>
               		</thead>
               	</table>
               	</div>
              </div>
            </div>
          </div>
        </div>   
      </div>
    </div>
    <div class="container">
    
    </div>
  </div>
</div>
</body>
</html>
