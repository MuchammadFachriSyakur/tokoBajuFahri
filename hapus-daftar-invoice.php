<?php
include("konek_db.php");
if(isset($_GET['hapus_invoice'])){
  $id = $_GET['id'];
  $sql = "DELETE FROM invoice WHERE id='$id'";
  $query = mysqli_query($db,$sql);
  if($query){
    header("location: daftar-order.php");
  }else{
    echo "Gagal Mas bray";
  }
}else{
  die("Akses Dilarang");
}
?>