<?php 
session_start();

include "koneksi.php";

$user= $_GET['user'];

$username = $_SESSION['username'];

    $s = "SELECT * from warung where username='$username'";
    $r = mysqli_query($koneksi, $s);
    $rw = mysqli_fetch_array($r, MYSQLI_ASSOC);
      $namawarung = $rw['Nama'];


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
    <?php if (empty($username)) {
      echo "<a href='index.php'><img src='logo.png'></a>";
    }else{

      echo "<a href='suksesmasuk.php'><img src='logo.png'></a>";
    } 
    ?>
      
      <ul class="nav navbar-nav navbar-right">
        
        <?php 
           if (empty($_SESSION['username'])) {
              echo "<li><a  href='login.php'><font style='color: #a349a4' size='4px'>";
               echo "<span class='glyphicon glyphicon-log-in'></span>";
               echo " Masuk";
               echo "</font></a></li>";
             }else{
              echo "<li><a  href='profil.php'><font style='color: #a349a4' size='4px'>";
              echo "<span class='glyphicon glyphicon-user'></span>";
              echo " $username";
              $selectpesanan1 = "SELECT COUNT(*) as jumlahpesanan from pesanan where Nama='$namawarung'";
              $jumlahpesanan = mysqli_query($koneksi, $selectpesanan1);
              $rowwww = mysqli_fetch_array($jumlahpesanan, MYSQLI_ASSOC);
              $pesananalert = $rowwww['jumlahpesanan'];
              echo "</font>";
                if (empty($pesananalert)) {
                
              }else{
                echo "<font color='#ae0018'>[".$pesananalert;
                echo "]</font>";
              }


              echo "</a></li>"; 
             }

         ?>

        
       
            <?php 

            if (empty($username) ) {
              echo "<li><a  href='daftar.php'><font style='color: #a349a4' size='4px'> Daftar</font></a></li> ";
              
            }else{
              if (empty($namawarung)) {
                echo " <li><a  href='warungku.php'>
          <font style='color: #a349a4' size='4px'>";

              echo "Warungku";
              echo "</font>
        </a></li> ";
              }else{
              echo " <li><a  href='warungku.php'>
          <font style='color: #a349a4' size='4px'>";

              echo $namawarung;
              echo "</font>
        </a></li> ";
            }
          }


         ?>
          
        <li>
        <?php 
            if (empty($username)) {
              # code...
            }else{

              echo "<a  href='keluar.php'><img src='keluar.png'></a>";      
            }
         ?>
        </li> 
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


            $selectuser = "SELECT * from user  where username='$user'";
            $hasil = mysqli_query($koneksi,$selectuser);
            $kol = mysqli_fetch_array($hasil, MYSQLI_ASSOC);


       ?>
         <div class="row-fluid">
      <div class="span12">
       <div class="text-left user-info">
           <h1><?php echo $kol['username']; ?></h1>
           <div class="col-sm-12 row" style="background-color: #5b4181"></div><br/>
           <?php 

            ?>
            <h2><?php echo $kol['nama_lengkap']; ?></h2>
           <ul class="user-personal">
             <li>
               <span class="glyphicon glyphicon-earphone"></span>
               <?php echo $kol['nohp']; ?>
             </li>
             <li>
               <span class="glyphicon glyphicon-envelope"></span>
               <?php echo $kol['email']; ?>
             </li>
             <li>
               <span class="glyphicon glyphicon-calendar"></span> <?php echo $kol['tanggallahir']; ?>
             </li>
             <?php 
                $selectwarunguser = "SELECT * from warung where username='$user'";
                $hasil1 = mysqli_query($koneksi, $selectwarunguser);
                $kol1 = mysqli_fetch_array($hasil1, MYSQLI_ASSOC);
                echo $kol1['Nama'];
                if (empty($kol1['Nama'])) {
                  echo "<li>";
                  echo "Belum mempunyai Warung";
                  echo "</li>";
                }else{
                  echo "<li>";
                  echo "Warung : ";
                  echo "<a href='tampilkanwarung.php?Nama=$kol1[Nama]'>";
                  echo $kol1['Nama'];
                  echo "</a>";
                  echo "</li>";
                }
              ?>
           </ul>
       </div>
      </div>
    </div>
    <br/><div class="col-sm-12 row" style="background-color: #5b4181"></div><br/>

      </div>
    </div>
</body>
</html>
