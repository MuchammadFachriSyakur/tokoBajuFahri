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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="src/css/daftar_barang.css" type="text/css" media="all" />
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
      <a href="tambah-produk.php">Tambah Produk</a>
       <div class="wrap_card">
       <?php
        $sql = "SELECT * FROM barang";
        $query = mysqli_query($db,$sql);
        while($siswa = mysqli_fetch_array($query)): ?>
        <div class="card">
            <img src="img/<?php echo $siswa['gambar_barang'];?>" alt="Picture Product" class="Picture">
            <p class="nama_barang"><?php echo $siswa['nama_barang']; ?></p>
            <?php $hasil_rupiah = "Rp " . number_format($siswa['harga_barang'],2,',','.'); ?>
            <p class="harga_barang" value="<?= $siswa['harga_barang']; ?>" style="display: none;"><?= $siswa['harga_barang']; ?></p>
            <p class="harga_barang_yang_tampil" value="<?php $siswa['harga_barang']; ?>"><?php echo $hasil_rupiah; ?></p>
            <p class="deskripsi_barang"><?php echo $siswa['deskripsi_barang']; ?></p>
            <div class="aksi">
              <?php 
               echo "<a href='hapus-barang.php?id=".$siswa['id']."&gambar_barang=".$siswa['gambar_barang']."'>Hapus</a>";
               echo "<a href='form-edit-barang.php?id=".$siswa['id']."'>Edit</a>";
              ?>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
  </div>

  <script src="src/js/navbar_admin.js"></script>
</body>

</html>