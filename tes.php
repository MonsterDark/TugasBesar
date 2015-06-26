<?php 
session_start();

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
  <link rel="stylesheet" type="text/css" href="style1.css" media="screen"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

  <style>
    body {
            background: url(purplebackground.png) repeat-x #fff;
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
        <li><a  href="profil.php"><img src="profil.png"></a></li>
        <li><a  href="warungku.php"><img src="warungku.png"></a></li> 
        <li><a  href="keluar.php"><img src="keluar.png"></a></li> 
      </ul>
    </div>
  </div>
  <div class="col-sm-12 row" style="background-color: #5b4181"></div>
`</div>
</header
<br/><br/><br/><br/><br/><br/>
<div class="content-container">
  <div class="container mb-20">


    <div id="closed"></div>
<a href="#popup">Klik untuk memunculkan Popup</a>
<div class="popup-wrapper" id="popup">
	<div class="popup-container"><!-- Konten popup, silahkan ganti sesuai kebutuhan -->
		<form action="" method="post" class="popup-form">
			<h2>Ikuti Update !!</h2>
				<div class="form-group">
    <label for="inputPassword2" class="sr-only">Password</label>
    <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-default">Confirm identity</button>
		</form>
		<a class="popup-close" href="#closed">X</a>
	</div>
</div>


  </div>
</div>
</body>
</html>
