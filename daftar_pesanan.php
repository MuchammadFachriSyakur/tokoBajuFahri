<?php
session_start();
include("konek_db.php");
if (isset($_POST['logout_user'])) {
  session_unset();
  session_destroy();
  header("location: index.php");
}

$username = $_SESSION['username'];
if (!$username) {
  echo "<script>
    window.location.href = 'index.php';
  </script>";
}
$total = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ellens closet | daftar invoice</title>
    <link rel="stylesheet" href="src/css/output.css" type="text/css" media="all" />
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <script src="https://kit.fontawesome.com/fddab9acea.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
  <link rel="manifest" href="img/site.webmanifest">
</head>
<body>
  <nav class="navbar w-full bg-slate-200 flex justify-center items-center sticky top-0 left-0 right-0">
    <div class="gridhome w-full max-w-[1000px] flex flex-col md:flex-row justify-center items-center">
      <div class="grid1 w-full md:w-[20%] p-3 flex justify-between items-center">
        <img class="logo w-[50px] h-[50px] bg-red-400 bg-cover bg-no-repeat bg-center object-cover" src="img/logo.jpg"
          alt="Logo" />
        <div class="hamburger md:hidden h-[20px] flex flex-col justify-between">
          <span class="w-[28px] h-[3px] rounded bg-slate-700"></span>
          <span class="w-[28px] h-[3px] rounded bg-slate-700"></span>
          <span class="w-[28px] h-[3px] rounded bg-slate-700"></span>
        </div>
      </div>
      <ul
        class="nav-link w-full flex flex-col md:flex-row md:w-[80%] md:inline-flex justify-center items-center gap-3 p-3 hidden">
        <li class="p-4 md:p-0"><a href="dashboard.php#">Home</a></li>
        <li class="p-4 md:p-0"><a href="dashboard.php#features">Featurs</a></li>
        <li class="p-4 md:p-0"><a href="dashboard.php#product">Product</a></li>
        <li class="p-4 md:p-0"><a href="#">Contact</a></li>
        <li class="p-4 md:p-0">
          <form method="POST" action="daftar_pesanan.php">
            <input type="text" name="userC" class="hidden" id="userC" value="<?= $username; ?>">
            <button type="submit" name="pesananku">Invoice</button>
          </form>
        </li>
        <li class="p-4 md:p-0">
          <form action="daftar-checkout.php" method="GET">
            <input type='text' class="hidden" name='username' id='username' value='<?= $username ?>' readonly>
            <button type="submit" name="lihat_daftar_checkout"><i class="ph ph-shopping-cart-simple"></i></button>
          </form>
        </li>
        <li class="p-4 md:p-0">
          <form method="POST" class="logout_user">
            <button type="submit" name="logout_user" id="logout_user"><i class="ph ph-sign-out"></i></button>
          </form>
        </li>
      </ul>
    </div>
  </nav>
  
  <div class="container w-full min-h-[80vh] flex flex-col justify-center items-center gap-5 py-10">
    <?php
      $sql = "SELECT * FROM invoice";
      $query = mysqli_query($db, $sql);
      while($data = mysqli_fetch_array($query)):
    ?>
      <?php 
      $status = $data['status'];
      $ongkir = $data['ongkir'];
      $layanan_pengiriman = $data['layanan_pengiriman'];
      $no_resi = $data['no_resi'];
      
      if($username == $data['username']): 
      ?>
    <form action="invc.php" method="GET" class="w-full max-w-[300px] flex flex-col justify-center items-start">
      <p class="text-2xl font-bold">Invoice</p>
      <input type="number" name="id" id="id" value="<?= $data['id']; ?>" class="hidden" />
      
      <div class="w-full flex flex-col justify-start items-center mb-4">
        <label for="kode_unik" class="w-full text-left">Kode Unik: </label>
        <input type="text" name="kode_unik" id="kode_unik" value="<?= $data['kode_unik']; ?>" class="w-full text-left outline-none border-none" readonly>
      </div>
      
      <div class="w-full flex flex-col justify-start items-center mb-4">
        <label for="username" class="w-full text-left">Username: </label>
        <input type="text" name="username" id="username" value="<?= $data['username']; ?>" class="w-full text-left outline-none border-none" readonly/>
      </div>
      
      <div class="hidden w-full flex flex-col justify-start items-center mb-4">
        <label for="username" class="w-full text-left">Id Barang: </label>
        <input type="text" name="id_barang" id="id_barang" value="<?= $data['id_barang']; ?>" class="w-full text-left outline-none border-none" readonly/>
      </div>
      
      <?php if(!$layanan_pengiriman == null): ?>
      <div class="w-full flex flex-col justify-start items-center mb-4">
        <label for="layanan_pengiriman" class="w-full text-left">Layanan pengiriman :</label>
        <input type="text" name="layanan_pengiriman" value="<?= $data['layanan_pengiriman']; ?>" class="w-full text-left outline-none border-none" readonly/>
      </div>
      <?php endif; ?>
      
      <?php if(!$no_resi == null): ?>
      <div class="w-full flex flex-col justify-start items-center mb-4">
        <label for="no_resi" class="w-full text-left">No resi :</label>
        <input type="text" name="no_resi" value="<?= $data['no_resi']; ?>" class="w-full text-left outline-none border-none" readonly/>
      </div>
      <?php endif; ?>
      
      <?php if($ongkir > 1 && !$layanan_pengiriman == null && !$no_resi == null): ?>
        <button type="submit" name="lihat_detail_invoice" class="px-6 py-3 bg-slate-700 text-white hover:bg-slate-400 hover:text-slate-700 ease-in-out duration-300 rounded-full">Lihat Detail</button>
      <?php endif; ?>
    </form>
      <?php endif; ?>
    <?php endwhile; ?>
  </div>
  
  <footer class="footer w-full flex flex-col justify-center items-center">
    <div class="w-full w-[1000px] flex flex-col-reverse gap-3 md:gap-3 md:flex-row justify-between items-center py-10 px-2 
    border-t-2 border-slate-400">
      <p>&copy; 2023 Your Company, Inc. All rights reserved.</p>
      <div class="logo flex justify-center flex-wrap items-center gap-4">
        <i
          class="fa-brands fa-facebook text-[26px] text-slate-400 hover:text-slate-700 transition-all ease-in-out duration-300"></i>
        <i
          class="fa-brands fa-instagram text-[26px] text-slate-400 hover:text-slate-700 transition-all ease-in-out duration-300"></i>
        <i
          class="fa-brands fa-x-twitter text-[26px] text-slate-400 hover:text-slate-700 transition-all ease-in-out duration-300"></i>
        <i
          class="fa-brands fa-github text-[26px] text-slate-400 hover:text-slate-700 transition-all ease-in-out duration-300"></i>
        <i
          class="fa-brands fa-youtube text-[26px] text-slate-400 hover:text-slate-700 transition-all ease-in-out duration-300"></i>
      </div>
    </div>
  </footer>
  <script src="src/js/navbarUser.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>