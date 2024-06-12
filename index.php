<?php 
include("konek_db.php");
session_start();
$message = "";
if(isset($_SESSION['is_login_admin'])){
  header("location: kelola_user.php");
}else if(isset($_SESSION['is_login_user'])){
  header("location: dashboard.php");
}
if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $hash_password = hash('sha256',$password);
  $sql = "SELECT * FROM user WHERE username='$username' AND
  password='$hash_password'";
  $query = mysqli_query($db,$sql);
  if($result = mysqli_num_rows($query)){
    $user = mysqli_fetch_array($query);
    $user_level = $user['level'];
    if($user_level == "admin"){
      $_SESSION['username'] = "Admin";
      $_SESSION['is_login_admin'] = true;
      header("location: kelola_user.php");
    }else{
      $_SESSION['username'] = $username;
      $_SESSION['is_login_user'] = true;
      header("location: dashboard.php");
    }
  }else{
    $message = "Akun tidak Ditemukan";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login | Ellen Closet</title>
  <link rel="stylesheet" href="src/css/login.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
rel="stylesheet">
  <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
  <link rel="manifest" href="img/site.webmanifest">
</head>
<body>
 <div class="container">
  <form class="form_login_user" method="POST">
    <p class="title">Login member</p>
    <p><?= $message;?></p>
    <p class="input">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" required>
    </p>
    <p class="input">
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>
    </p>
    <a href="registrasi.php" class="link_to_register">Belum mempunyai akun?</a>
    <button type="submit" name="login" id="login">Login</button>
  </form>
 </div>
</body>
</html>