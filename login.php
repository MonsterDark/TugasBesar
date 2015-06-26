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
      width: 480px;
      height:20px;
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
    <div id="masuk" class="tab-pane fade in active">
       	<div class="content-container">
      		 <h2><font color="#CC00CC">Masuk</font></h2><br/>
  <div class="col-sm-12 row" style="background-color: #5b4181"></div><br/>
  <form class="form-horizontal" role="form" method="post">
    <div class="form-group">
      <label class="col-sm-4 control-label">Username</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="text" name="username">
      </div>
    </div>
     <div class="form-group">
      <label class="col-sm-4 control-label">Kata kunci</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="password" name="pass">
      </div>
    </div> 
     

  <?php 
  	include ("koneksi.php");

	if (isset($_POST['ok'])) {
		$username = $_POST['username'];
		$pass = $_POST['pass'];

		$select = "SELECT * from user where username='$username' AND pass='$pass'";
		$result = mysqli_query($koneksi, $select);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		session_start();


		if (mysqli_num_rows($result) == 1) {
			$_SESSION['email'] = $row['email'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['nohp'] = $row['nohp'];
      $_SESSION['uang'] = $row['uang'];
      $_SESSION['tgllahir'] = $row['tanggallahir'];
			echo '<meta http-equiv="refresh" content="0; url=suksesmasuk.php">';
		}else{

			echo "<div class='alert alert-danger' role='aleert'>Login gagal!!! Periksa kembali Username password anda</div>";
		}
	}
	?>
 <div class="container">
         <div id="notif" align="left">
             
              <button type="submit" class="btn btn-default btn-block" name="ok" value="ok"><font color="#CC00CC">Masuk</font></button>
           </div>
           <br/></div><a href="daftar.php">Belum punya akun??</a>
       </div> 
  
  </div>
  </form>
    <div class="col-sm-12 row" style="background-color: #5b4181"></div><br/><br/>
      	</div>   
    </div>
   
  </div>

</body>
</html>
