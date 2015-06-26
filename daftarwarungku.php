<?php 
	include "koneksi.php";

	session_start();

  $username = $_SESSION['username'];

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
    #notif{
      width: 500px;
      height: 80px;
      background: #fd8294;
    }
</style>
</head>
<body class="home-only">

<header class="navbar navbar-fixed-top";>
  
<div class="col-sm-12 row" style="background-color: #5b4181"></div>
<div class="col-sm-12 row" style="background-color: #5b4181"></div>
  <div class="navbar-inner" style="background-color: #ffffff">
    <div class="container">
      <a href="suksesmasuk.php"><img src="logo.png"></a>
      <ul class="nav navbar-nav navbar-right">
        <li><a  href="profil.php"><font style="color: #a349a4" size="4px"><span class="glyphicon glyphicon-user"></span> <?php echo "$username"; ?></font></a></li>
        <li><a  href="warungku.php"><font style="color: #a349a4" size="4px">Warungku</font></a></li> 
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
    <div id="daftar" class="tab-pane fade in active">
      	<div class="content-container">
 
  <form class="form-horizontal form-register box box-white box-shadow mb-30" role="form" method="post">
   <h2><font color="#CC00CC">Daftar Warungku</font></h2>
      		 <div class="col-sm-12 row" style="background-color: #5b4181"></div><br/>
    <div class="form-group">
      <label class="col-sm-4 control-label">Nama Warung</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="text" name="namawarung" value="<?php 
if (isset($_POST['ok'])) {
              echo $_POST['namawarung'];
            }
         ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label">Slogan</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="text" name="slogan" value="<?php 
        if (isset($_POST['ok'])) {
              echo $_POST['slogan'];
            } ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label">Deskripsi</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="text" name="deskripsi" value="<?php 
        if (isset($_POST['ok'])) {
              echo $_POST['deskripsi'];
            } ?>">
      </div>
    </div><br/>
    <div class="col-sm-12 row" style="background-color: #5b4181"></div><br/>
    <h1><font color="#CC00CC">Alamat</font></h1>
     <div class="form-group">
      <label class="col-sm-4 control-label">Kecamatan</label>
      <div class="col-sm-4">
      <script  src="selectdesa.js"></script>
       
           <select name="kecamatan" class="form-control" onChange="showDesa(this.value)">

           <option value=null>Kecamatan</option>

             <?php 
             $kec = "SELECT * from kecamatan";
            $rkec = mysqli_query($koneksi, $kec);
                while ($a = mysqli_fetch_array($rkec)) {
                 list($idkec, $namakec)=$a;

              echo "<option value=".$namakec.">".$namakec."</option>";
                  }
          

        ?>
		</select>
      </div>
    </div>
     <div class="form-group">
      <label class="col-sm-4 control-label">Desa</label>
      <div class="col-sm-4">
         <select name="desa" class="form-control" id="txtHint">
         <option value=null>Desa</option>
           
         </select>
      </div>
      
    </div>
     <div class="form-group">
      <label class="col-sm-4 control-label">Jalan</label>
      <div class="col-sm-4">
       <input class="form-control" id="focusedInput" type="text" name="jalan" value="<?php 
       if (isset($_POST['ok'])) {
              echo $_POST['jalan'];
            } ?>">
      </div>
    </div>
    <div class="form-group">
    <script>
function myFunction() {
    var x = document.getElementById("fname");
    x.value = x.value.toUpperCase();
}
</script>
      <label class="col-sm-4 control-label">NO</label>
      <div class="col-sm-4">
        <input class="form-control" id="fname" onblur="myFunction()" type="text" name="nomer" value="<?php 
        if (isset($_POST['ok'])) {
              echo $_POST['nomer'];
            } ?>">
      </div>
    </div>
    <div class="form-group" >
      <label class="col-sm-4 control-label">Kode Pos</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="text" name="kodepos" value="<?php 
        if (isset($_POST['ok'])) {
              echo $_POST['kodepos'];
            } ?>">
      </div>
    </div>

      <div class="container">
          <?php 

        if (isset($_POST['ok'])) {
        	# code...
        	$namawarung = $_POST['namawarung'];
        	$slogan = $_POST['slogan'];
        	$deskripsi = $_POST['deskripsi'];
        	$kecamatan = $_POST['kecamatan'];
        	$desa = $_POST['desa'];
        	$jalan = $_POST['jalan'];
        	$nomer = $_POST['nomer'];
        	$kodepos = $_POST['kodepos'];
        	$username = $_SESSION['username'];

        	$insert = "INSERT into warung (Nama, selogan, Deskripsi, kecamatan, desa, jalan, no, kodepos, username) 
        							values('$namawarung', '$slogan', '$deskripsi', '$kecamatan', '$desa', '$jalan', '$nomer', '$kodepos', '$username')";


        	$slectwarung = "SELECT * from warung";
			    	$resultwarung = mysqli_query($koneksi, $slectwarung);
			    	
            while ($rowwarung = mysqli_fetch_array($resultwarung, MYSQLI_ASSOC)) {
             $nmwarung = $rowwarung['Nama'];
            }


        	if ($namawarung == null) {
        		echo "<div class='alert alert-danger container-fluid'>";
			    echo "Nama Warung Tidak boleh Kosong";
			    echo "</div>";
        	}elseif ($slogan == null) {
        		echo "<div class='alert alert-danger container-fluid'>";
			    echo "Slogan Tidak boleh Kosong";
			    echo "</div>";
        	}elseif ($deskripsi == null) {
        		echo "<div class='alert alert-danger container-fluid'>";
			    echo "Deskripsi Tidak boleh Kosong";
			    echo "</div>";
        	}elseif ($kecamatan == null) {
        		echo "<div class='alert alert-danger container-fluid'>";
			    echo "Kecamatan Tidak boleh Kosong";
			    echo "</div>";
        	}elseif ($desa == null) {
        		echo "<div class='alert alert-danger container-fluid'>";
			    echo "Desa Tidak boleh Kosong";
			    echo "</div>";
        	}elseif ($jalan == null) {
        		echo "<div class='alert alert-danger container-fluid'>";
			    echo "Jalan Tidak boleh Kosong";
			    echo "</div>";
        	}elseif ($nomer == null) {
        		echo "<div class='alert alert-danger container-fluid'>";
			    echo "Nomer Tidak boleh Kosong";
			    echo "</div>";
        	}elseif ($kodepos == null) {
        		echo "<div class='alert alert-danger container-fluid'>";
			    echo "Kodepos Tidak boleh Kosong";
			    echo "</div>";
        	}elseif ($namawarung ==  $nmwarung) {
        		echo "<div class='alert alert-danger container-fluid'>";
			    echo "Nama Warung Sudah Dipakai";
			    echo "</div>";
        	}elseif ($resultinsert = mysqli_query($koneksi, $insert)) {
        		echo '<meta http-equiv="refresh" content="0; url=warungku.php">';
        	}
        }
         
 		?>


      </div><br/>
      <div class="container">
         <div id="notif" align="left">
             <ul>
               <li>Harap tidak menginformasikan username dan password Anda kepada siapapun, termasuk pihak yang mengatasnamakan Warung jember.</li>
               <li>Demi kenyamanan, Nama warung serta informasi lainnya tidak dapat diubah lagi setelah pendaftaran </li>
             </ul>
             <button type="submit" class="btn btn-default btn-block" name="ok" value="ok"><font color="#CC00CC">Daftar</font></button>
           </div>
       </div>
            <div id="verify_number"></div>
  </form><br/>
  <div class="col-sm-12 row" style="background-color: #5b4181"></div><br/>
      	</div>   
    </div>
  </div>
  </div>


</body>
</html>
