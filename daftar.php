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
    #notif{
      width: 700px;
      height: 60px;
      background: #fd8294;
    }
</style>
</head>
<body>


<header class="navbar navbar-fixed-top">
  <div class="col-sm-12 row" style="background-color: #5b4181"></div>
  <div class="col-sm-12 row" style="background-color: #5b4181"></div>
    <div class="navbar-inner" style="background-color: #ffffff">
        <div class="container">
          <a href="index.php"><img src="logo.png"></a>
        <ul class="nav nav-tabs navbar-nav navbar-right">
          <li><a  href="login.php"><font style="color: #a349a4" size="4px"><span class="glyphicon glyphicon-log-in"></span> Masuk</font></a></li>
          <li><a  href="daftar.php"><font style="color: #a349a4" size="4px"> Daftar</font></a></li> 
        </ul>
        </div>
    </div>
  <div class="col-sm-12 row" style="background-color: #5b4181"></div>
</header>
<div class="container">
<div id="verify_number"></div>
  <div class="container" align="center">
  	<div class="tab-content">
    <div id="daftar" class="tab-pane fade in active">
      	<div class="content-container">
      		 <h2><font color="#CC00CC">Daftar</font></h2>
      		 <div class="col-sm-12 row" style="background-color: #5b4181"></div><br/>
          

  <form class="form-horizontal form-register box box-white box-shadow mb-30" role="form" method="post">
    <div class="form-group">
      <label class="col-sm-4 control-label">Nama Lengkap</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="text" name="nama_lengkap" value="<?php 
            if (isset($_POST['ok'])) {
              echo $_POST['nama_lengkap'];
            }

         ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label">Username</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="text" name="username" value="<?php 
          if (isset($_POST['ok'])) {
              echo $_POST['username'];
            }


         ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label">Email</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="email" name="email" value="<?php 
            if (isset($_POST['ok'])) {
              echo $_POST['email'];
            }

         ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label">No Handpon</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="text" name="nohp" value="<?php 
              if (isset($_POST['ok'])) {
              echo $_POST['nohp'];
            }


         ?>">
      </div>
    </div>
     <div class="form-group">
      <label class="col-sm-4 control-label">Tanggal lahir</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="date" name="tgl">
      </div>
    </div>
     <div class="form-group">
      <label class="col-sm-4 control-label">Jenis Kelamin</label>
      <div class="radio col-sm-4">
  		  <div class="container">
              <div align="left"><input type="radio" name="jeniskel" id="optionRadios1" value="pria" >Laki-laki</div>
              <div align="left"><input type="radio" name="jeniskel" id="optionRadios2" value="wanita" >Perempuan</div>
        </div>
      </div>
    </div>
     <div class="form-group">
      <label class="col-sm-4 control-label">Kata kunci</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="password" name="pass">
      </div>
    </div>
     <div class="form-group">
      <label class="col-sm-4 control-label">Ulangi kata kunci</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="password" name="pass1">
      </div>
    </div>

      <div class="container">
        <?php 
          include "koneksi.php";

        if (isset($_POST['ok'])) {
          $nama_lengkap = $_POST['nama_lengkap'];
          $username = $_POST['username'];
          $tgl = $_POST['tgl'];
          $jeniskel = isset($_POST['jeniskel']) ? $_POST['jeniskel']:'';
          $pass = $_POST['pass'];
          $email = $_POST['email'];
          $nohp = $_POST['nohp'];
          $pass1 = $_POST['pass1'];

   $query = "INSERT into user (username, tanggallahir, jeniskelamin, nohp, pass, email, nama_lengkap) values ('$username', '$tgl', '$jeniskel',
         '$nohp', '$pass', '$email', '$nama_lengkap')";
    $select = "SELECT * from user";
    $result = mysqli_query($koneksi, $select);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($nama_lengkap == null) {
      echo "<div class='alert alert-danger container-fluid'>";
     echo "Nama lengkap Tidak boleh Kosong";
     echo "</div>";
    }elseif ($username == null) {
     echo "<div class='alert alert-danger container-fluid'>";
     echo "Username Tidak boleh Kosong";
     echo "</div>";
    }elseif ($email == null) {
      echo "<div class='alert alert-danger container-fluid'>";
     echo "Emailail Tidak boleh Kosong";
     echo "</div>";
    }elseif ($nohp == null) {
      echo "<div class='alert alert-danger container-fluid'>";
     echo "Nomer Handphone Tidak boleh Kosong";
     echo "</div>";
    }elseif ($tgl == null) {
      echo "<div class='alert alert-danger container-fluid'>";
     echo "Tanggal lahir Tidak boleh Kosong";
     echo "</div>";
    }elseif ($jeniskel == null) {
      echo "<div class='alert alert-danger container-fluid'>";
     echo "Jeis kelamin Tidak boleh Kosong";
     echo "</div>";
    }elseif ($pass == null) {
      echo "<div class='alert alert-danger container-fluid'>";
     echo "Password Tidak boleh Kosong";
     echo "</div>";
    }elseif ($pass != $pass1) {
      echo "<div class='alert alert-danger container-fluid'>";
     echo "Ulangi kunci tidak sama";
     echo "</div>";
    }elseif ($username == $row['username']) {
        echo "<div class='alert alert-danger container-fluid'>";
     echo "Username sudah digunakan";
     echo "</div>";
      
    }else{
      $result1 = mysqli_query($koneksi, $query);
      

    if ($result1) {
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    $select = "SELECT * from user where username='$username' AND pass='$pass'";
    $result = mysqli_query($koneksi, $select);
    $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);

  
session_start();

    if (mysqli_num_rows($result) == 1) {
        
      $_SESSION['email'] = $row1['email'];
      $_SESSION['username'] = $row1['username'];
      $_SESSION['nohp'] = $row1['nohp'];
      echo '<meta http-equiv="refresh" content="0; url=suksesmasuk.php">';
    }else{

      echo "<div class='alert alert-danger' role='aleert'>Kesalahan</div>";
    }
  }
    }
  }
 ?>


      </div>

       <div class="container">
         <div id="notif" align="left">
             <ul>
               <li>Harap tidak menginformasikan username dan password Anda kepada siapapun, termasuk pihak yang mengatasnamakan Warung jember.</li>
               <li>Demi kenyamanan, Username serta informasi lainnya tidak dapat diubah lagi setelah pendaftaran </li>
             </ul>
              <button type="submit" class="btn btn-default btn-block" name="ok" value="ok"><font color="#CC00CC">Daftar</font></button>
           </div>
       </div> 
    <br/><br/><br/></div><a href="login.php">Sudah punya akun?</a>
  </form>
  <div class="col-sm-12 row" style="background-color: #5b4181"></div><br/>
  <div id="verify_number"></div>
      	</div>   
    </div>
  </div>
  </div>



</body>
</html>
