<?php
include("konek_db.php");
if(!isset($_GET['id'])){
  header("location: kelola_user.php");
}
$id = $_GET['id'];
$sql = "SELECT * FROM user WHERE id=$id";
$query = mysqli_query($db,$sql);
$siswa = mysqli_fetch_assoc($query);

if(mysqli_num_rows($query) < 1){
  die("data tidak ditemukan");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link rel="stylesheet" href="src/css/form_edit_barang.css" type="text/css" media="all" />
</head>
<body>
  <form action="proses-edit-user.php" method="POST" class="form_edit_barang">
    <h1>Formulir Edit User</h1>
    <p>
      <label for="username">Id</label>
      <input type="text" name="id" id="id" value="<?= $siswa['id']; ?>" readonly>
    </p>
    <p>
      <label for="username">Username</label>
      <input type="text" name="username" id="username" value="<?=
      $siswa['username'];
      ?>">
    </p>
    <p>
      <label for="password">Password</label>
      <input type="password" name="password" id="password" value="<?=
      $siswa['password']; ?>">
    </p>
    <p>
      <label for="created-at">Tanggal Dibuat</label>
      <input type="text" name="created-at" id="created-at" value="<?=
      $siswa['created-at']; ?>" readonly>
    </p>
    <p>
      <label for="created-at">Level</label>
      <input type="text" name="level" id="level" value="<?= $siswa['level']; ?>">
    </p>
    <button type="submit" name="edit_user" id="edit_user" class="btn_edit">Edit</button>
  </form>
</body>
</html>