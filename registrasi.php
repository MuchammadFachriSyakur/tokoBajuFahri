<?php
include("konek_db.php");
$registrasi_message = "";

if(isset($_POST['registrasi'])){
  $username = $_POST['username'];
  $password = htmlspecialchars($_POST['password']);
  $hash_password = hash('sha256',$password);
  
  
    $sql = "INSERT INTO user (username,password) VALUES ('$username','$hash_password')";

    if($db->query($sql)){
     $registrasi_message = "Akun berhasil ditambahkan";
     header("location: index.php");
    }else{
     $registrasi_message = "Username yang anda masukan sudah ada!!!";
    }
  $db->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Registrasi</title>
  <link rel="stylesheet" href="src/css/login.css"/>
</head>
<body>
<div class="container">
  <form class="form_login_user" method="POST">
    <p class="title">Registrasi member</p>
    <p><?= $registrasi_message;?></p>
    <p class="input">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" required>
    </p>
    <p class="input">
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>
    </p>
    <a href="index.php" class="link_to_register">Sudah mempunyai akun?</a>
    <button type="submit" name="registrasi" id="register">Login</button>
  </form>
 </div>
</body>
</html>