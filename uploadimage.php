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
      <h3><font color="#CC00CC">Upload gambar</font></h3>
       <div class="col-sm-12 row" style="background-color: #5b4181"></div><br/>
 
  <form method="post" enctype="multipart/form-data" class="form-contlor">
  
  <div class="form-group">
      <label class="col-sm-4 control-label"></label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="file" name="img" >
      </div>
    </div>

  <?php 
    if (isset($_POST['ok'])) {
      $namafoto = $_FILES['img']['name'];
      $type = $_FILES['img']['type'];
      $fsize = $_FILES['img']['size'];
      $ftemp = $_FILES['img']['tmp_name']; 

      
      $direktori = "gambar/$namafoto";


      echo $namafoto; echo "<br/>";
      echo $type; echo "<br/>";
      echo $fsize; echo "<br/>";
      echo $ftemp;

      $insert = "INSERT into images (name) values ('$namafoto')";
      $seselai = mysqli_query($koneksi, $insert);

      if ($seselai) {
        # code...
        $upload = move_uploaded_file($ftemp,$direktori);
      if ($upload) {
        echo "berrrrhasssssilllll";


    echo "<img src='gambar/$namafoto'>";    
    }
  }else{
    echo mysqli_error($koneksi);
  }

}
   ?>
   <button type="submit" name="ok" value="ok" class="btn btn-default"><font color="#CC00CC">Tambah</font></button>
    <button type="submit" name="no" value="no" class="btn btn-default"><font color="#CC00CC">Batal</font></button>
</form>
  <div class="col-sm-12 row" style="background-color: #5b4181"></div><br/>
  </div>
  </div>
  </div>
</div>
</body>
</html>
