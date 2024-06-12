<?php
include("konek_db.php");
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $sql = "DELETE FROM user WHERE id=$id";
  $query = mysqli_query($db,$sql);
  if($query){
    header("location: kelola_user.php");
  }else{
    die("gagal menghapus user");
  }
}else{
  die("Akses Dilarang");
}
?>