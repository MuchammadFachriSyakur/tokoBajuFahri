<?php
session_start();
include ("konek_db.php");
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ellens closet</title>
  <link rel="stylesheet" href="src/css/output.css" type="text/css" media="all" />
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <script src="https://kit.fontawesome.com/fddab9acea.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
  <link rel="manifest" href="img/site.webmanifest"> 
  <style>
    *{
      scroll-behavior: smooth;
    }
  </style> 
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
        <li class="p-4 md:p-0"><a href="#">Home</a></li>
        <li class="p-4 md:p-0"><a href="#features">Featurs</a></li>
        <li class="p-4 md:p-0"><a href="#product">Product</a></li>
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

  <div class="hero w-full bg-slate-200 flex justify-center items-center">
    <div class="section w-full max-w-[1000px] flex flex-wrap justify-center items-center px-3">
      <div class="w-full md:w-[50%] min-h-[450px] flex flex-col justify-center items-start">
        <p class="text-3xl font-bold mb-4 text-green-700 md:text-5xl">Belanja lebih cepat dan mudah</p>
        <p class="text-[18px] md:text-[20px] text-slate-800 mb-4">Temukan semua yang kamu butuhkan & dapatkan pengalaman
          belanja menyenangkan!</p>
        <button class="py-2 px-5 bg-slate-800 text-white rounded-full">Beli Sekarang!</button>
      </div>
      <div class="w-full md:w-[50%] h-[450px] flex justify-center items-end">
        <img loading="lazy" class="w-full max-w-[400px] h-[400px]" src="img/hero.png" alt="Hero Section">
      </div>
    </div>
  </div>

  <div class="featurs w-full flex justify-center items-center" id="features">
    <div class="w-full max-w-[1000px] flex flex-wrap justify-center items-center gap-4 py-10 md:py-16 px-3">

      <div
        class="card w-full max-w-[175px] flex flex-col justify-center items-center gap-5 p-4 border border-slate-300 shadow shadow-slate-300 rounded">
        <img loading="lazy" class="w-[100px] h-[100px] bg-cover bg-no-repeat bg-center object-cover" src="img/f1.png" alt="Logo">
        <button class="py-2 px-4 rounded bg-violet-200 text-violet-600 text-[14px]">Free Shipping</button>
      </div>

      <div
        class="card w-full max-w-[175px] flex flex-col justify-center items-center gap-5 p-4 border border-slate-300 shadow shadow-slate-300 rounded">
        <img loading="lazy" class="w-[100px] h-[100px] bg-cover bg-no-repeat bg-center object-cover" src="img/f2.png" alt="Logo">
        <button class="py-2 px-4 rounded bg-pink-200 text-pink-600 text-[14px]">Online Order</button>
      </div>

      <div
        class="card w-full max-w-[175px] flex flex-col justify-center items-center gap-5 p-4 border border-slate-300 shadow shadow-slate-300 rounded">
        <img loading="lazy" class="w-[100px] h-[100px] bg-cover bg-no-repeat bg-center object-cover" src="img/f3.png" alt="Logo">
        <button class="py-2 px-4 rounded bg-slate-200 text-slate-600 text-[14px]">Save Money</button>
      </div>

      <div
        class="card w-full max-w-[175px] flex flex-col justify-center items-center gap-5 p-4 border border-slate-300 shadow shadow-slate-300 rounded">
        <img loading="lazy" class="w-[100px] h-[100px] bg-cover bg-no-repeat bg-center object-cover" src="img/f4.png" alt="Logo">
        <button class="py-2 px-4 rounded bg-sky-200 text-sky-600 text-[14px]">Promotions</button>
      </div>

    </div>
  </div>

  <div class="container w-full m-auto max-w-[1000px] flex flex-col justify-center items-center">
    <?php
    $suqwl = "SELECT * FROM kategori_produk";
    $qwry = mysqli_query($db, $suqwl);
    ?>
    <div class="w-full kategori-produk flex flex-wrap justify-center items-center gap-5 py-3 mb-5" id="product">
      <?php while ($data = mysqli_fetch_array($qwry)): ?>
        <button class="categoryProduct" data-kategori="<?= $data['jenis_kategori']; ?>"><?= $data['jenis_kategori']; ?></button>
      <?php endwhile; ?>
    </div>
    <?php
    $sql = "SELECT * FROM barang";
    $query = mysqli_query($db, $sql);
    ?>
    <div class="wrap_card flex flex-wrap justify-center items-center gap-4 md:gap-10 md:justify-between py-10">
      <?php while ($data = mysqli_fetch_array($query)): ?>
        
        <form action="detail_produk.php" method="GET"
          class="card_item w-full max-w-[200px] p-3 flex flex-col justify-center items-center rounded"
          data-kategori="<?= $data['kategori_produk']; ?>">

          <input type='text' class="hidden" name='username' id='username' value='<?=
            $username ?>' readonly>

          <input type='text' class="hidden" name='id' id='id' value='<?= $data['id']; ?>' readonly>

          <button type='submit' name="lihat_produk" class="w-full">
            <img loading="lazy" src="img/<?= $data['gambar_barang']; ?>" alt="Product" class="gambar w-full h-[180px] bg-cover bg-no-repeat bg-center object-cover rounded">
            <p class="w-full text-[18px] font-bold mb-2 mt-2 bg-transparent whitespace-nowrap overflow-hidden text-ellipsis"><?= $data['nama_barang']; ?></p>
            <?php $hasil_rupiah = "Rp " . number_format($data['harga_barang'], 2, ',', '.'); ?>
            <p><?= $hasil_rupiah; ?></p>
          </button>
        </form>
      <?php endwhile; ?>
    </div>
  </div>

  <div class="w-full flex flex-col justify-ce items-start md:items-center py-16 px-3"
    style="background-image : url('img/b2.jpg')">
    <p class="text-[16px] text-white font-bold mb-5">Repair service</p>
    <p class="text-white text-3xl md:text-4xl font-black mb-4">Up to <span class="text-red-600">70% Off</span> All
      t-Shirt & Accessories</p>
    <button class="py-2 px-6 bg-green-600">Explore More</button>
  </div>

  <div class="w-full flex flex-col justify-center items-center py-12">

    <div class="w-full max-w-[1000px] flex flex-col justify-center items-center gap-4">
      <div class="grd1 w-full flex flex-wrap justify-center md:justify-between items-center py-10 px-3 gap-5">
        <div class="w-full md:w-[48%] h-[300px] flex flex-col justify-center items-start p-8"
          style="background-image: url('img/b17.jpg')">
          <p class="text-[16px] text-white font-normal mb-3">carzy deals</p>
          <p class="text-3xl text-white font-bold mb-3">Buy 1 get 1 free</p>
          <p class="text-[14px] text-white font-normal mb-2">The basic dres is on of cara</p>
          <button
            class="py-2 px-7 border border-white hover:border-black text-white hover:bg-black duration-300 ease-in-out">Learn
            More</button>
        </div>
        <div class="w-full md:w-[48%] h-[300px] flex flex-col justify-center items-start p-8"
          style="background-image: url('img/b10.jpg')">
          <p class="text-[16px] text-white font-normal mb-3">spring/summer</p>
          <p class="text-3xl text-white font-bold mb-3">Upcoming Season</p>
          <p class="text-[14px] text-white font-normal mb-2">The basic dres is on of cara</p>
          <button
            class="py-2 px-7 border border-white hover:border-black text-white hover:bg-black duration-300 ease-in-out">Collection</button>
        </div>
      </div>
    </div>

    <div class="w-full max-w-[1000px] flex flex-wrap justify-center md:justify-between items-center gap-4 px-3">
      <div
        class="w-full md:w-[30%] h-[200px] flex flex-col justify-center items-center p-8 bg-cover bg-no-repeat bg-center object-cover"
        style="background-image: url('img/b7.jpg')">
        <p class="text-white text-3xl font-bold mb-4
        ">Seasonal Sale</p>
        <p class="text-white">Winter Collection -50% Off</p>
      </div>
      <div
        class="w-full md:w-[30%] h-[200px] flex flex-col justify-center items-center p-8 bg-cover bg-no-repeat bg-center object-cover"
        style="background-image: url('img/b4.jpg')">
        <p class="text-white text-3xl font-bold mb-4
        ">NEW FOOTWEAR COLLECTION</p>
        <p class="text-white">Spiring/Summer</p>
      </div>
      <div
        class="w-full md:w-[30%] h-[200px] flex flex-col justify-center items-center p-8 bg-cover bg-no-repeat bg-center object-cover"
        style="background-image: url('img/b18.jpg')">
        <p class="text-white text-3xl font-bold mb-4
        ">T-SHIRT</p>
        <p class="text-white">New Trendy</p>
      </div>
    </div>
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
  <script src="src/js/filterKategori.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>