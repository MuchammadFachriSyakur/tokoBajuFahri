<?php
include("konek_db.php");
if(!isset($_GET['lihat_invoice'])){
  echo "<script>
  alert('Anda dilarang masuk');
  window.location.href = 'daftar-order.php';
  </script>";
}
$id = $_GET['id'];
$username = $_GET['username'];
$count = 0;
$mentahanArray;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="src/css/admin_1.css" type="text/css" media="all" />
  <link rel="stylesheet" href="src/css/detailinvoice.css" type="text/css" media="all" />
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
      $sql = "SELECT * FROM invoice";
      $query = mysqli_query($db, $sql);
      while($data = mysqli_fetch_array($query)):
      $mentahanArray = $data['id_barang'];
       if($data['id'] == $id): ?>
     <form action="proses_edit_detail_invoice.php" method="GET" class="form_checkout">
       <h3>Formulir Checkout</h3>
       
       <div class="form_1">
         <label for="id">Id :</label>
         <input type="number" name="id" value="<?= $data['id']; ?>" readonly>
       </div>
       
       <div class="form_1">
         <label for="nama_lengkap">Nama lengkap:</label>
         <input type="text" name="nama_lengkap" value="<?= $data['nama_lengkap']; ?>" readonly>
       </div>
       
       <div class="form_1">
         <label for="alamat">Alamat:</label>
         <input type="text" name="alamat" value="<?= $data['alamat']; ?>" readonly>
       </div>
       
       <div class="form_1">
         <label for="no_telepon">No telepon :</label>
         <input type="text" name="no_telepon" value="<?= $data['no_telepon']; ?>" readonly>
       </div>
       
       <div class="form_1">
         <label for="tanggal">Tanggal Pembelian :</label>
         <input type="datetime" name="tanggal" value="<?= $data['created_at']; ?>">
       </div>
       
       <div class="form_1">
         <label for="status">Status Barang :</label>
         <input type="text" name="status" value="<?= $data['status']; ?>">
       </div>
       
       <div class="form_1">
         <label for="ongkir">Ongkir :</label>
         <input type="number" min="0" name="ongkir" value="<?= $data['ongkir']; ?>">
       </div>
       
       <div class="form_1">
         <label for="layanan_pengiriman">Layanan Pengiriman :</label>
         <input type="text" name="layanan_pengiriman" value="<?= $data['layanan_pengiriman']; ?>">
       </div>
       
       <div class="form_1">
         <label for="no_resi">Nomor resi :</label>
         <input type="text" name="no_resi" value="<?= $data['no_resi']; ?>">
       </div>
       
       <div class="form_1">
         <label for="catatan_penjual">Catatan Penjual :</label>
         <input type="text" name="catatan_penjual" value="<?= $data['catatan_penjual']; ?>">
       </div>
       
       <button type="submit" class="btn_submit_form" name="update">Update</button>
     </form>
      <?php endif;?>
    <?php endwhile; ?>
     
    <div class="responsive-table">
    <table class="w-full" cellspacing="0">
     <thead class="w-full bg-slate-800 text-slate-300">
      <tr>
        <th class="p-2">Id</th>
        <th class="p-2">Nama Barang</th>
        <th class="p-2">Jumlah Barang</th>
        <th class="p-2">Harga Barang</th>
        <th class="p-2">Gambar Barang</th>
        <th class="p-2">Harga Total</th>
      </tr>
     </thead>
     
     <tbody>
       <?php
        $explode = explode(",",$mentahanArray);  
        $sqla = "SELECT * FROM checkout";
        $querya = mysqli_query($db, $sqla);
        while($data = mysqli_fetch_array($querya)) {
            $id = $data['id'];
            $nama_barang = $data['nama_barang'];
            $jumlah_barang = $data['jumlah_barang'];
            $harga_barang = $data['harga_barang'];
            $gambar_barang = $data['gambar_barang'];
            $harga_total = $data['harga_total'];
            $status = $data['status'];
            $id = $data['id'];
            foreach ($explode as $dataArray){
              $angka = (int)$dataArray;
              if($id == $angka){
               echo "<tr>";
               echo "<td>".$id."</td>";
               echo "<td>".$nama_barang."</td>";
               echo "<td>".$jumlah_barang."</td>";
               $ubahHargaBarangKerupiah = "Rp " . number_format($harga_barang,2,',','.');
               echo "<td>".$ubahHargaBarangKerupiah."</td>";
               echo "<td>".$gambar_barang."</td>";
               $ubahHargaTotalKeRupiah = "Rp " . number_format($harga_total,2,',','.');
               echo "<td>".$ubahHargaTotalKeRupiah."</td>";
               echo "</tr>";
            }
            }
            
        }
        ?>
     </tbody>
    </table>
    </div>
    
   </div>
  </div>
  
  <script src="src/js/navbar_admin.js"></script>
</body>
</html>