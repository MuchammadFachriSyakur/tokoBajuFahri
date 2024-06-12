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
$id;
if (isset($_GET['lihat_produk'])) {
    $id = $_GET['id'];
}else{
    echo "<script>
    window.location.href = 'dashboard.php';
  </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ellen Closet | detail produk</title>
    <link rel="stylesheet" href="src/css/output.css" type="text/css" media="all" />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://kit.fontawesome.com/fddab9acea.js" crossorigin="anonymous"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
</head>

<body>
    <nav class="navbar w-full bg-slate-200 flex justify-center items-center sticky top-0 left-0 right-0">
        <div class="gridhome w-full max-w-[1000px] flex flex-col md:flex-row justify-center items-center">
            <div class="grid1 w-full md:w-[20%] p-3 flex justify-between items-center">
                <img class="logo w-[50px] h-[50px] bg-red-400 bg-cover bg-no-repeat bg-center object-cover"
                    src="img/logo.jpg" alt="Logo" />
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
                <li class="p-4 md:p-0"><a href="dashboard.php#">Contact</a></li>
                <li class="p-4 md:p-0">
                    <form method="POST" action="daftar_pesanan.php">
                        <input type="text" name="userC" class="hidden" id="userC" value="<?= $username; ?>">
                        <button type="submit" name="pesananku">Invoice</button>
                    </form>
                </li>
                <li class="p-4 md:p-0">
                    <form action="daftar-checkout.php" method="GET">
                        <input type='text' class="hidden" name='username' id='username' value='<?= $username ?>'
                            readonly>
                        <button type="submit" name="lihat_daftar_checkout"><i
                                class="ph ph-shopping-cart-simple"></i></button>
                    </form>
                </li>
                <li class="p-4 md:p-0">
                    <form method="POST" class="logout_user">
                        <button type="submit" name="logout_user" id="logout_user"><i
                                class="ph ph-sign-out"></i></button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="contain w-full min-h-[70vh] flex flex-col justify-center items-center p-3 py-10">
    <?php
    $sql = "SELECT * FROM barang WHERE id='$id'";
    $query = mysqli_query($db, $sql);

    while ($data = mysqli_fetch_assoc($query)):
        ?>

          <form action="proses-tambah-keranjang.php" method="GET" class="w-full max-w-[650px] flex  flex-col justify-center items-center gap-2">
            <input type='text' class="hidden" name='username' id='username' value='<?=
            $username ?>' readonly>
            
            <input type='text' class="hidden" name='id' id='id' value='<?= $data['id']; ?>' readonly>

            <input type='text' class="hidden" name='gambar_barang' id='gambar_barang' value='<?= $data['gambar_barang'] ?>'
            readonly>

            <input type='text' class="hidden" name='nama_barang'
            id='nama_barang' value='<?= $data['nama_barang'] ?>' readonly>

            <input type='text' class="hidden" name='harga_barang' id='harga_barang' value='<?= $data['harga_barang']; ?>'
            readonly>

            <div class="w-full max-w-[650px] flex justify-center items-center gap-2">
             
              <div class="w-full md:w-[50%] flex flex-col justify-center items-center">
               <img class="gambar w-full h-[300px] bg-cover bg-no-repeat bg-center object-cover rounded" src="img/<?= $data['gambar_barang']; ?>" alt="<?= $data['nama_barang']; ?>">
              </div>

              <div class="w-full md:w-[50%] flex flex-col justify-center items-center p-4">
                 <p class="w-full text-[18px] font-bold mb-2 mt-2 bg-transparent whitespace-nowrap overflow-hidden text-ellipsis"><?= $data['nama_barang']; ?></p>
                 <?php $hasil_rupiah = "Rp " . number_format($data['harga_barang'], 2, ',', '.'); ?>

                 <p class="w-full text-[14px] font-normal mb-2 mt-2 bg-transparent whitespace-nowrap overflow-hidden text-ellipsis"><?= $hasil_rupiah; ?></p>

                 <p class="w-full text-[14px] font-normal mb-2 mt-2 bg-transparent whitespace-nowrap overflow-hidden text-ellipsis">Kategori : <?= $data['kategori_produk']; ?></p>

                 <p>Deskripsi : <?= $data['deskripsi_barang']; ?></p>
              </div> 
            </div>
            
            <button type='submit' class='w-full beli_barang py-2 px-6 rounded bg-green-200 text-green-600 text-[14px] mt-2'
            name='beli_barang'>Beli</button>
         </form>

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