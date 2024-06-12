<?php
include ("konek_db.php");
if (isset($_POST['tambah-barang'])) {
  $nama_barang = htmlspecialchars($_POST['nama_barang']);
  $harga_barang = $_POST['harga_barang'];
  $deskripsi_barang = htmlspecialchars($_POST['deskripsi_barang']);
  $kategori = htmlspecialchars($_POST['kategori_produk']);
  $image = $_FILES['gambar_barang']['name'];
  $tmp = $_FILES['gambar_barang']['tmp_name'];
  $eror = $_FILES['gambar_barang']['error'];
  $size = $_FILES['gambar_barang']['size'];
  $ekstensiGambarValid = ['jpg', 'jpeg', 'webp', 'svg', 'gif', 'png'];
  $ektensiGambar = explode('.', $image);
  $ektensiGambar = strtolower(end($ektensiGambar));
  $namafile = uniqid();
  $namafile .= '.';
  $namafile .= $ektensiGambar;

  if ($size > 1000000) {
    echo "<script>
      alert('Data melebihi 1mb');
    </script>";
    return false;
  }

  $sql = "INSERT INTO barang (nama_barang,harga_barang,deskripsi_barang,gambar_barang,kategori_produk) VALUES ('$nama_barang','$harga_barang','$deskripsi_barang','$namafile','$kategori')";
  $query = mysqli_query($db, $sql);
  if ($query) {
    echo "<script>
      alert('Data Berhasil disimpan');
    </script>";
  } else {
    echo "<script>
      alert('Data tidak berhasil disimpan');
    </script>";
  }
  $location = "img/" . $namafile;
  move_uploaded_file($tmp, $location);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Toko Fahri </title>
  <link rel="stylesheet" href="src/css/form_edit_barang.css" type="text/css" media="all" />
</head>

<body>
  <a href="kelola-daftar-makanan.php">Kembali ke kelola barang</a>
  <form method="POST" class="form_edit_barang" enctype="multipart/form-data">
    <h1>Formulir Tambah Barang</h1>
    <p>
      <label for="nama_barang">Nama Barang</label>
      <input type="text" name="nama_barang" id="nama_barang" required>
    </p>
    <p>
      <label for="tambah-barang">Harga Barang</label>
      <input type="number" name="harga_barang" id="harga_barang" required>
    </p>
    <p>
      <label for="deskripsi_barang">Deskripsi Barang</label>
      <input qtype="text" name="deskripsi_barang" id="deskripsi_barang" required>
    </p>
    <p>
      <label for="gambar_barang">gambar Barang</label>
      <input type="file" name="gambar_barang" id="gambar_barang" required>
    </p>
    <p>
      <select name="kategori_produk" id="kategori_produk">
        <?php
        $qry = $db->query("SELECT * FROM  kategori_produk");
        while ($data = $qry->fetch_assoc()): ?>
          <option value="<?= $data['jenis_kategori']; ?>"><?= $data['jenis_kategori']; ?></option>
        <?php endwhile; ?>
      </select>
    </p>
    <button type="submit" name="tambah-barang" id="tambah-barang">submit</button>
  </form>
</body>

</html>