<?php
include("konek_db.php");
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $sql = "DELETE FROM checkout WHERE id=$id";
  $query = mysqli_query($db,$sql);
  if($query){
    header("location: daftar-checkout.php");
  }else{
    die("gagal menghapus barang");
  }
}else{
  die("Akses Dilarang");
}
?>