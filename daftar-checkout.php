<?php
session_start();
include ("konek_db.php");
$username = $_SESSION['username'];
if (!$username) {
  echo "<script>
    window.location.href = 'index.php';
  </script>";
}

$cekBenar = 0;
$sql = "SELECT * FROM checkout";
$query = mysqli_query($db, $sql);
while ($siswa = mysqli_fetch_array($query)) {
  $status = $siswa['status'];
  if ($username == $siswa['nama'] && $status == 'dalam checkout') {
    $cekBenar = 1;
  }
}
$dataBarangCheckout = array(-0);
$total = 0;

$barangToWa = array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ellens closet | daftar checkout</title>
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
  <nav class="navbar w-full bg-slate-200 flex justify-center items-center sticky top-0 left-0 right-0"
    style="z-index: 100;">
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

  <div class="containProdukYgAdaDiKeranjang w-full py-10 flex flex-col justify-center items-center gap-2">
    <div class="wrap_card w-full max-w-[1000px] m-auto flex flex-col justify-center items-center px-3 mb-8 gap-4">
      <?php
      $sql = "SELECT * FROM checkout";
      $query = mysqli_query($db, $sql);
      ?>
      <?php while ($siswa = mysqli_fetch_array($query)): ?>
        <?php $status = $siswa['status']; ?>
        <?php if ($username == $siswa['nama'] && $status == 'dalam checkout'): ?>

          <?php array_push($dataBarangCheckout, $siswa['id']); ?>

          <?php array_push($barangToWa, $siswa['nama_barang'] . " x " . $siswa['jumlah_barang']); ?>

          <form class="card_checkout w-full max-w-[250px] p-3" action="proses-edit-jumlah-checkout.php" method="GET">

            <div class="wrapDeleter w-full flex flex-col justify-center items-end">
              <?php echo "<a class='btn_link text-3xl w-[50px] h-[50px] text-center flex justify-center items-center p-2 rounded-full bg-red-700 text-white hover:bg-red-500 hover:duration-300 hover:ease-in-out' style='margin-bottom: -25px;z-index: 20;margin-right: -20px;' href='hapus_checkout.php?id=" . $siswa['id'] . "'>&times;</a>"; ?>
            </div>

            <input type="number" class="hidden" name="id_barang" id="id_barang" value="<?=
              $siswa['id']; ?>" readonly>

            <input type="text" class="hidden" name="gambar_barang" id="gambar_barang" value="<?=
              $siswa['gambar_barang']; ?>" readonly>

            <img src="img/<?= $siswa['gambar_barang']; ?>"
              class="gambar w-full h-[250px] bg-cover bg-center bg-no-repeat object-cover  rounded"
              style="box-sizing: border-box; width: 100%;" />

            <p class="w-full text-[20px] font-bold whitespace-nowrap text-ellipsis overflow-hidden pt-4 mb-2">
              <?= $siswa['nama_barang']; ?>
            </p>

            <input type="text" class="hidden" name="nama_barang" id="nama_barang" value="<?= $siswa['nama_barang']; ?>"
              readonly />

            <?php
            $rupiahHargaPersatuanProduct = "Rp " . number_format($siswa['harga_barang'], 2, ',', '.');
            ?>

            <p class="w-full text-[16px] font-normal whitespace-nowrap text-ellipsis overflow-hidden mb-2">
              <?= $rupiahHargaPersatuanProduct; ?>
            </p>

            <input type="number" class="hidden" name="harga_barang" id="harga_barang" value="<?= $siswa['harga_barang']; ?>"
              readonly />

            <input min="1" type="number"
              class="w-full bg-transparent p-2 outline-none border-2 border-slate-300 rounded-2xl mb-2 focus:border-slate-400 focus:shadow focus:shadow-slate-700"
              name="jumlah_barang" id="jumlah_barang" value="<?= $siswa['jumlah_barang']; ?>" />

            <input type="text" class="hidden" name="nama" id="nama" value="<?= $siswa['nama'];
            ?>" readonly />

            <?php
            $total += $siswa['harga_total'];
            $rupiahHargaTotalProduct = "Rp " . number_format($siswa['harga_total'], 2, ',', '.');
            ?>

            <p class="w-full text-[16px] font-normal whitespace-nowrap text-ellipsis overflow-hidden mb-2">
              <?= $rupiahHargaTotalProduct; ?>
            </p>

            <input type="number" class="hidden" name="total_percheckout" value="<?= $siswa['harga_total'];
            ?>">

            <div class="linked w-full flex justify-center items-center p-2">
              <button type="submit" name="update_data"
                class='btn_link py-3 px-8 bg-black text-white rounded-full hover:bg-slate-600 hover:duration-300 hover:ease-in-out'>Update</button>
            </div>
          </form>
        <?php endif; ?>
      <?php endwhile; ?>

      <?php
      $rupiahTotalKeranjang = "Rp " . number_format($total, 2, ',', '.');
      ?>
      <?php if($total > 1) : ?>

        <p>Total: <?= $rupiahTotalKeranjang; ?></p>

        <a class="w-full max-w-[300px] flex justify-center items-center" href="https://api.whatsapp.com/send?phone=6287715240225&text=*Perihal Pesanan Pembelian Barang*%0A%0APesan ini berfungsi sebagai pesanan pembelian untuk barang-barang berikut%0A<?php

          foreach ($barangToWa as $data) {
           echo "%0A" . $data;
          }

        ?>%0A%0ATerimakasih atas waktu dan bantuannya.">

        <p>Checkout ke whatsapp</p> <img class="w-[65px] h-[65px]" src="img/waLogo.png" alt="Whatsapp Logo">
      </a>

      <?php endif; ?>

    </div>
    <?php if ($cekBenar == 1) { ?>
      <form action="proses-checkout.php" method="GET"
        class="w-full m-auto max-w-[500px] flex flex-col justify-center items-center p-3 mt-5">
        <h2 class="text-3xl font-bold mb-10">Informasi Pengiriman</h2>

        <?php $serializeData = htmlentities(serialize($dataBarangCheckout)); ?>
        <input type="text" class="hidden" name="daftar_barang" value="<?= $serializeData; ?>" required>

        <div class="w-full flex flex-col justify-start items-start mb-5">
          <label for="username" class="text-[16px] font-bold mb-2">Username:</label>
          <input type="text"
            class="w-full outline-none border border-slate-300 focus:border-sky-500 py-3 px-6 rounded focus:shadow focus:shadow-sky-500"
            id="username" name="username" value="<?= $username; ?>" readonly>
        </div>

        <div class="w-full flex flex-col justify-start items-start mb-5
        ">
          <label for="nama" class="text-[16px] font-bold mb-2">Nama Lengkap:</label>
          <input type="text"
            class="w-full outline-none border border-slate-300 focus:border-sky-500 py-3 px-6 rounded focus:shadow focus:shadow-sky-500"
            id="username" id="nama" name="nama" placeholder="Masukan Nama Lengkap Anda" required>
        </div>

        <div class="w-full flex flex-col justify-start items-start mb-5">
          <label for="alamat" class="text-[16px] font-bold mb-2">Alamat Pengiriman:</label>
          <textarea
            class="w-full outline-none border border-slate-300 focus:border-sky-500 py-3 px-6 rounded focus:shadow focus:shadow-sky-500"
            name="alamat" id="alamat" cols="40" rows="3" placeholder="Masukan Alamat yang dituju" required></textarea>
        </div>

        <h2 class="text-3xl font-bold mb-7 mt-10">Informasi Kontak</h2>

        <div class="w-full flex flex-col justify-start items-start mb-5">
          <label for="email" class="text-[16px] font-bold mb-2">Email:</label>
          <input type="email" id="email" name="email"
            class="w-full outline-none border border-slate-300 focus:border-sky-500 py-3 px-6 rounded focus:shadow focus:shadow-sky-500"
            placeholder="Masukan email anda" required>
        </div>

        <div class="w-full flex flex-col justify-start items-start mb-5">
          <label for="telepon" class="text-[16px] font-bold mb-2">Nomor Telepon:</label>
          <input type="tel" id="telepon" name="telepon"
            class="w-full outline-none border border-slate-300 focus:border-sky-500 py-3 px-6 rounded focus:shadow focus:shadow-sky-500"
            placeholder="Masukan nomor telepon anda" required>
        </div>

        <h2 class="text-3xl font-bold mb-4 mt-3">Informasi Pembayaran (Rekening Bank)</h2>
        
        <div class="w-full flex flex-col justify-start items-start mb-5">
          <label for="pembayaran" class="text-[16px] font-bold mb-2">Pembayaran :</label>
          <select id="pembayaran" name="pembayaran" class="w-full outline-none border border-slate-300 focus:border-sky-500 py-3 px-6 rounded focus:shadow focus:shadow-sky-500"
            placeholder="Masukan nomor telepon anda" required>
            <option value="cash-on-delivery">COD(cash on delivery)</option>
          </select>
        </div>
        

        <button name="selesaikan-pembayaran" id="selesaikan-pembayaran"
          class="btn_pembayaran w-full py-3 px-8 bg-black text-white hover:bg-slate-600 hover:duration-300 hover:ease-in-out rounded">Selesaikan
          Pembayaran</button>
      </form>
    <?php } else {
      echo "<div class='w-full min-h-[80vh] flex flex-col justify-center items-center'>
      <div class='card'>
        <img src='img/not_cart.svg' class='mb-4' alt='No items'>
        <p class='text-[20px] text-slate-700 font-bold'>Yah, keranjang kamu masih kosong nih</p>
      </div>
    </div>";
    } ?>
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
  <script src="src/js/konfirmCheckout.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>