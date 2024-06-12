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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Ellen Closet</title>
    <link rel="stylesheet" href="src/css/admin_1.css" type="text/css" media="all" />
    <link rel="stylesheet" href="src/css/kelola_jenis_kategori.css">
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
            <h1 class="title">Kelola Daftar kategori produk</h1>

              <form class="tambah_kategori" action="proses_tambah_kategori.php" method="get">
                <input type="text" name="kategori" id="kategori" required placeholder="Masukan kategori jenis produk yang anda inginkan">
                <button type="submit" name="kirim_kategori_produk">Kirim</button>
              </form>
              
              <div class="card">
                <?php
                $sql = "SELECT * FROM kategori_produk";
                $query = mysqli_query($db,$sql);
              
                while($data = mysqli_fetch_array($query)):
                ?>
                   <form class="item_kategori" action="proses_edit_jenis_kategori.php" method="GET">
                 
                     <input type="number" id="id" name="id" value="<?= $data['id']; ?>" readonly>
                 
                     <input type="text" id="name" name="name" value="<?= $data['jenis_kategori']; ?>">
                 
                     <div class="aksi">
                       <button type="submit" name="edit_kategori">Edit</button>
                       <a href="hapus_kategori.php?id=<?= $data['id']; ?>">Hapus</a>
                     </div>
                    </form>
                <?php endwhile; ?>
              </div>
        
        </div>
    </div>

    <script src="src/js/navbar_admin.js"></script>
</body>
</html>