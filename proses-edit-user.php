<?php
include("konek_db.php");

if(isset($_POST['edit_user'])){
  $id = $_POST['id'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $hash_password = hash('sha256',$password);
  $created = $_POST['created-at'];
  $level = $_POST['level'];
  
  $sql = "UPDATE user SET
  username='$username',password='$hash_password',level='$level'
  WHERE id=$id";
  $query = mysqli_query($db,$sql);
  if($query){
    header("location: kelola_user.php");
  }else{
    die("Gagal Menyimpan");
  }
}else{
  die("akses dilarang");
}
?>