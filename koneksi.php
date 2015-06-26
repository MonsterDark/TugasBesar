<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$databasename = "tugasbesar";

	$koneksi = mysqli_connect($servername, $username, $password, $databasename);

	if(mysqli_connect_errno()){
		printf("connect filed: ", mysqli_connect_error());
		exit();
	}
?>