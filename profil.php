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
        <li><a  href="profil.php"><font style="color: #a349a4" size="4px"><span class="glyphicon glyphicon-user"></span> <?php echo "$username ";

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

              echo $namawarung." ";

            
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
  <div class="container mb-20">

          <?php 

            $selectbeli = "SELECT produk.Nama, produk.namaproduk, beli.stok, beli.id_beli, beli.username
                            from produk 
                            inner join beli
                            on produk.id_produk=beli.id_produk
                            where beli.username='$username'";
            $hasilbeli = mysqli_query($koneksi, $selectbeli);
            $kolbeli = mysqli_fetch_array($hasilbeli, MYSQLI_ASSOC);
            $id_beli = $kolbeli['id_beli'];
           

            if (empty($kolbeli['username'])) {
              
            }else{  ?>

                <div id="verify_number"></div>
              <div class="col-sm-12 row" style="background-color: #5b4181"></div>
               <h4>Pembelian <?php echo $kolbeli['namaproduk']; ?> Berhasil</h4>
               <ul>
                 <li>Jumlah yang dibeli <?php echo $kolbeli['stok']; ?></li>
                 <li>Dijual di Warung 
                    <?php 
                         echo "<a href='tampilkanwarung.php?Nama=$kolbeli[Nama]'>";
                          echo $kolbeli['Nama'];
                          echo "</a>";

                     ?>
                 </li>
               </ul>

          <form method="post">
            <button class="btn btn-default" type="submit" name="ok" value="ok">OK</button><br/><br/>
            <div class="col-sm-12 row" style="background-color: #5b4181"></div>
            
          </form>

       <?PHP   
        if (isset($_POST['ok'])) {
          
          $hapusbeli = "DELETE from beli where id_beli=$id_beli";
          $selesai = mysqli_query($koneksi, $hapusbeli);

          if ($selesai) {
            header("Location: profil.php");
          }

        }


         }

           ?>













    <div class="row-fluid">
      <div class="span12">
       <div class="text-left user-info">
           <h1><?php echo $_SESSION['username']; ?></h1>
           <div class="col-sm-12 row" style="background-color: #5b4181"></div><br/>
           <?php 
            $selectuser = "SELECT * from user where username='$username'";
            $userh = mysqli_query($koneksi,$selectuser);
            $userkol = mysqli_fetch_array($userh, MYSQLI_ASSOC);

            ?>
            <h2><?php echo $userkol['nama_lengkap']; ?></h2>
           <ul class="user-personal">
             <li>
               <span class="glyphicon glyphicon-earphone"></span>
               <?php echo $userkol['nohp']; ?>
             </li>
             <li>
               <span class="glyphicon glyphicon-envelope"></span>
               <?php echo $userkol['email']; ?>
             </li>
             <li>
               <span class="glyphicon glyphicon-calendar"></span> <?php echo $userkol['tanggallahir']; ?>
             </li>
             <li>
               Total Uang penjualan Rp.<?php echo $userkol['uang']; ?>
             </li>
           </ul>
       </div>
      </div>
    </div>
    <br/><div class="col-sm-12 row" style="background-color: #5b4181"></div><br/>
    <div class="row-fluid">
      <div class="span12">
        <?php 
        $username = $_SESSION['username'];
            $selectwr = "SELECT * from warung where username='$username'";
            $resultwr = mysqli_query($koneksi, $selectwr);
            $rowwr = mysqli_fetch_array($resultwr, MYSQLI_ASSOC);


              
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
                  $no = $ow['no'];
                  $kp = $ow['kodepos'];
                  $deskripsi = $ow['Deskripsi'];
                }
             
         ?>
            <div class="text-left user-info">
              <h1>Warungku <?php echo $wru; ?></h1><a href="hapuswarung.php">Hapus Warungku</a>
              <h3><?php echo $deskripsi;  ?></h3>
                <div class="col-sm-12 row" style="background-color: #5b4181"></div><br/>
                  <ul class="user-personal">
                    <li>
                      kecamatan <?php echo "$kec"; ?>
                    </li>
                    <li>
                      Desa <?php echo "$des"; ?>
                    </li>
                    <li>
                      Jalan <?php echo "$jl"; ?>
                    </li>
                    <li>
                      NO <?php echo "$no"; ?>
                    </li>
                    <li>
                      Slogan "<?php echo "$lsg"; ?>"
                    </li>
                    <li>
                      Kodepos : <?php echo "$kp"; ?>
                    </li>
                  </ul>
                </div>
            </div>


         <?php } ?>
      </div>
    </div>
  </div>
  <div class="container"> 
  <div id="verify_number"></div>
  <div class="col-sm-8 row" style="background-color: #5b4181"></div>
  <div id="verify_number"></div>
    <?php 
     if (empty($wru)) {
        $selectpesanan = "SELECT produk.namaproduk, produk.namakategori, produk.kondisi, pesanan.Nama, 
                                                produk.harga, produk.id_produk, pesanan.id_pesanan,
                                                pesanan.stok, pesanan.username
                                        from produk
                                        inner join pesanan
                                        on produk.id_produk=pesanan.id_produk where pesanan.username ='$username'";
      $pesanan = mysqli_query($koneksi, $selectpesanan);     
     }else{
         $selectpesanan = "SELECT produk.namaproduk, produk.namakategori, produk.kondisi, pesanan.Nama, 
                                                produk.harga, produk.id_produk, pesanan.id_pesanan,
                                                pesanan.stok, pesanan.username
                                        from produk
                                        inner join pesanan
                                        on produk.id_produk=pesanan.id_produk where pesanan.username ='$username' or pesanan.Nama='$wru'";
      $pesanan = mysqli_query($koneksi, $selectpesanan);     


     }
     



     while ($kol = mysqli_fetch_array($pesanan, MYSQLI_ASSOC)) {
          $usernamepemesan = $kol['username'];
          $warungtujuan = $kol['Nama'];
          $id_produk = $kol['id_produk'];
     }









        if (empty($id_produk)) {






        }else{


        if ($username == $usernamepemesan) {
          ?>

          <table class="table table-hover">
            <thead>
              <tr>
                <th>
                  <h2>
                    Barang yang di order
                  </h2>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php 
                   $selectygdiorder1 = "SELECT produk.namaproduk, produk.namakategori, produk.kondisi, pesanan.Nama, produk.Nama,
                                                produk.harga, produk.id_produk, pesanan.id_pesanan,
                                                pesanan.stok
                                        from produk
                                        inner join pesanan
                                        on produk.id_produk=pesanan.id_produk where pesanan.username ='$username'";
                   $hygdiorder1 = mysqli_query($koneksi, $selectygdiorder1);
                   while ($col1 = mysqli_fetch_array($hygdiorder1, MYSQLI_ASSOC)) {
                      echo "<tr>";
                      echo "<td>";
                      echo "<h4>";
                        echo $col1['namaproduk'];
                      echo "</h4>";
                      echo "<ul>";
                        echo "<li>";
                        echo $col1['namakategori'];
                        echo "</li>";
                        echo "<li>";
                        echo "Kondisi ".$col1['kondisi'];
                        echo "</li>";
                        echo "<li>";
                        echo "Jumlah stok yang di pesan ".$col1['stok'];
                        echo "</li>";
                        echo "<li>";
                        echo "Dijual di Warung ";
                         echo "<a href='tampilkanwarung.php?Nama=$col1[Nama]'>";
                          echo $col1['Nama'];
                          echo "</a>";
                        echo "</li>";
                      echo "</ul>";
                      echo "</td>";
                      echo "<td><br/><h4>";
                        echo "Rp.".$col1['harga'];
                      echo "</h4></td>";
                      echo "<td>";
                        echo "<br/>";
                        echo "<a href='batalkanorder.php?id_pesanan=$col1[id_pesanan]&&id_produk=$col1[id_produk]
                        &&harga=$col1[harga]&&stok=$col1[stok]'>";
                        echo "<h4>";
                        echo "Batalkan <span class='glyphicon glyphicon-shopping-cart'></span> ORDER";
                        echo "</h4>";
                        echo "</a>";
                      echo "</td>";
                      echo "</tr>";
                    } 
                  }
               ?>
            </tbody>
          </table>

      <?php
      if (empty($wru)) {
        
      }else{

        if ($wru == $warungtujuan) {
         
          ?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>
                  <h4>Barang yang di pesan</h4>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php 
                   $selectygdiorder1 = "SELECT produk.namaproduk, produk.namakategori, produk.kondisi, pesanan.Nama, 
                                                produk.harga, produk.id_produk, pesanan.id_pesanan,
                                                pesanan.stok, pesanan.username
                                        from produk
                                        inner join pesanan
                                        on produk.id_produk=pesanan.id_produk where pesanan.Nama='$wru'";
                   $hygdiorder1 = mysqli_query($koneksi, $selectygdiorder1);
                   while ($col1 = mysqli_fetch_array($hygdiorder1, MYSQLI_ASSOC)) {
                    $id_pesanan = $col1['id_pesanan'];
                    if (empty($col1['id_produk'])) {
                        $deletepesanan = "DELETE from pesanan where id_pesanan=$id_pesanan";
                        $selesai = mysqli_query($koneksi,$deletepesanan);
                    }else{
                      echo "<tr>";
                      echo "<td>";
                      echo "<h4>";
                        echo $col1['namaproduk'];
                      echo "</h4>";
                      echo "<ul>";
                        echo "<li>";
                        echo $col1['namakategori'];
                        echo "</li>";
                        echo "<li>";
                        echo "Kondisi ".$col1['kondisi'];
                        echo "</li>";
                        echo "<li>";
                        echo "Jumlah stok yang di pesan ".$col1['stok'];
                        echo "</li>";
                          echo "<li>";
                          echo "Dipesan oleh ";
                          echo "<a href='tampilkanuser.php?user=$col1[username]'>";
                          echo $col1['username'];
                          echo "</a>";
                          echo "</li>";
                      echo "</ul>";
                      echo "</td>";
                      echo "<td><br/><h4>";
                        echo "Rp.".$col1['harga'];
                      echo "</h4></td>";
                      echo "<td>";
                        echo "<br/>";
                        echo "<a href='jual.php?id_pesanan=$col1[id_pesanan]&&id_produk=$col1[id_produk]&&harga=$col1[harga]&&stok=$col1[stok]'>";
                        echo "<h4>";
                        echo "Jual";
                        echo "</h4>";
                        echo "</a>";
                      echo "</td>";
                      echo "<td>";
                        echo "<br/>";
                        echo "<a href='batalkanorder.php?id_pesanan=$col1[id_pesanan]&&id_produk=$col1[id_produk]
                        &&harga=$col1[harga]&&stok=$col1[stok]'>";
                        echo "<h4>";
                        echo "Tolak <span class='glyphicon glyphicon-shopping-cart'></span> ORDER";
                        echo "</h4>";
                        echo "</a>";
                      echo "</td>";
                      echo "</tr>";
                    } 

                  }}
               ?>
            </tbody>
            <tbody>
              <tr>
                <td>
                  
                </td>
              </tr>
            </tbody>
          </table>


          <?php
        } 
        }
     ?>
  </div>
</div>
</body>
</html>
