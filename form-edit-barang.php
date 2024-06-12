<?php
include("konek_db.php");
if(!isset($_GET['id'])){
  header("location: kelola_user.php");
}
$id = $_GET['id'];
$sql = "SELECT * FROM barang WHERE id=$id";
$query = mysqli_query($db,$sql);
$siswa = mysqli_fetch_assoc($query);
$kategoriProduk = $siswa['kategori_produk'];

if(mysqli_num_rows($query) < 1){
  die("data tidak ditemukan");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Form Edit Barang</title>
  <link rel="stylesheet" href="src/css/form_edit_barang.css" type="text/css" media="all" />
</head>
<body>
  <form method="POST" class="form_edit_barang" enctype="multipart/form-data"
  action="proses-edit-barang.php">
    <h1>Formulir Edit Barang</h1>
    
    <p>
      <label for="id_barang">Id barang:</label>
      <input type="text" readonly value="<?=
      $siswa['id'];?>" name="id_barang" id="id_barang"> 
    </p>

    <p>
      <label for="nama_barang">Nama Barang:</label>
      <input type="text" name="nama_barang" id="nama_barang" value="<?=
      $siswa['nama_barang'];?>">
    </p>

    <p>
      <label for="tambah-barang">Harga Barang:</label>
      <input type="number" name="harga_barang" id="harga_barang" value="<?=
      $siswa['harga_barang'];?>">
    </p>

    <p>
      <label for="deskripsi_barang">Deskripsi Barang:</label>
      <input type="text" name="deskripsi_barang" id="deskripsi_barang" value="<?=
      $siswa['deskripsi_barang'];?>">
    </p>

    <select name="kategori_produk" id="kategori_produk">

     <?php
      $qry = $db->query("SELECT * FROM  kategori_produk");
      while ($data = $qry->fetch_assoc()): ?>
      <option
       <?php if($kategoriProduk == $data['jenis_kategori']): ?>
         selected
       <?php endif; ?>
      value="<?= $data['jenis_kategori']; ?>"><?= $data['jenis_kategori']; ?></option>
     <?php endwhile; ?>

    </select>

    <p class="div_gambar">
      <p class="title">Gambar Sebelumnya:</p>
      <img src="img/<?= $siswa['gambar_barang']?>" class="Picture" style="box-sizing: border-box; width: 100%; max-height: 250px; background-size: cover; background-position: top center; object-fit: cover; background-repeat: no-repeat;">
    </p>

    <p>
      <label for="gambar_barang">Gambar Barang:</label>
      <input type="file" name="gambar_barang" id="gambar_barang" value="img/<?=
      $siswa['gambar_barang'];?>">
    </p>

    <button type="submit" name="edit-barang" id="edit-barang" class="btn_edit">submit</button>
  </form>
</body>
</html>