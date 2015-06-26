<?php 
$q = $_GET["q"];

include "koneksi.php";

 $kec = "SELECT * from desa where namakec='$q'";
            $rkec = mysqli_query($koneksi, $kec);
                while ($a = mysqli_fetch_array($rkec, MYSQLI_ASSOC)) {
                  # code...

              echo "<option value=".$a['namadesa'].">".$a['namadesa']."</option>";
                  }

?>