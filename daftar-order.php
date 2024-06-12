<?php
session_start();
include ("konek_db.php");
if (isset($_POST['logout_admin'])) {
  session_unset();
  session_destroy();
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/css/daftar_order.css" type="text/css" media="all" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
  <nav class="nav-bar">
    <h1>Admin Page</h1>
    <div class="toggle">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>
  <div class="container">
   <div class="grid1">
      <ul class="wrap_linked">
        <li><a href="kelola_user.php">Kelola Daftar User</a></li>
        <li><a href="kelola-daftar-makanan.php">Kelola Daftar Barang</a></li>
        <li><a href="daftar-order.php">Daftar Order</a></li>
        <li><a href="kelola_kategori_produk.php">Kelola daftar kategori produk</a></li>
        <li>
          <form method="POST">
            <button type="submit" name="logout_admin">Logout</button>
          </form>
        </li>
      </ul>
    </div>
    <div class="grid2">
      <?php
      $sql = "SELECT * FROM user";
      $query = mysqli_query($db, $sql);
      ?>
      <div class="wrap_card">
        <?php
        $sql = "SELECT * FROM invoice";
        $query = mysqli_query($db, $sql);
        ?>
        <?php while($siswa = mysqli_fetch_array($query)): ?>
          <div class="card_checkout">
             <div class="grid">
             <p class="title">Id:</p>
             <p><?= $siswa['id']; ?></p>
          </div>
          <div class="grid">
             <p class="title">Username:</p>
             <p><?= $siswa['username']; ?></p>
          </div>
          <div class="grid">
             <p class="title">Nama Lengkap:</p>
             <p><?= $siswa['nama_lengkap']; ?></p>
          </div>
          <div class="grid">
             <p class="title">Alamat:</p>
             <p><?= $siswa['alamat']; ?></p>
          </div>
          <div class="aksi">
            
            <form class="card" action="detail_invoice.php" method="get">
              <input type="number" name="id" id="id" value="<?= $siswa['id']; ?>" readonly/>
               <input type="text" name="username" id="username" value="<?=
            $siswa['username']; ?>"
            readonly/>
               <button type="submit" name="lihat_invoice">Lihat</button>
            </form>

            <form action="hapus-daftar-invoice.php" method="GET">
              <input type="number" name="id" value="<?= $siswa['id']; ?>" readonly>
              <button type="submit" name="hapus_invoice">Hapus</button>
           </form>

          </div>
       </div>
        <?php endwhile;?>
      </div>
    </div>
  </div>

  <script src="src/js/navbar_admin.js"></script>
</body>
</html>